<?php

// edited by Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Interfaces\PaymentReceiptGeneratorInterface;

class PaymentController extends Controller
{
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
