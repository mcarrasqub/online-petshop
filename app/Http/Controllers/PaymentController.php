<?php

// edited by Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Interfaces\PaymentReceiptGeneratorInterface;
use App\Models\Order;
use App\Models\Payment;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly CartService $cartService
    ) {}

    public function index(string $id): View
    {
        $order = Order::with('user')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('payment.title_index');
        $viewData['order'] = $order;

        return view('payment.index')->with('viewData', $viewData);
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $payment = Payment::create($request->validated());

        $order = Order::with('orderItems.product')->findOrFail($payment->getOrderId());
        $this->orderService->decreaseStockFromOrder($order);
        $this->cartService->removeAll($request);

        return redirect()->route('payment.success', $payment->getId());
    }

    public function success(string $id): View
    {
        $payment = Payment::with('order')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('payment.title_success');
        $viewData['payment'] = $payment;

        return view('payment.success')->with('viewData', $viewData);
    }

    public function receipt(Payment $payment, PaymentReceiptGeneratorInterface $receiptGenerator): Response
    {
        $payment->load('order.user');

        return $receiptGenerator->generate($payment);
    }
}

