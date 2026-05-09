<?php

// edited by Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(string $id): View
    {
        $order = Order::findOrFail($id);
        $order->load('user');

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

    public function receipt(string $id)
    {
        $payment = Payment::with('order.user')->findOrFail($id);

        $viewData = [];
        $viewData['payment'] = $payment;

        $pdf = Pdf::loadView('payment.receipt', compact('viewData'));

        return $pdf->download('comprobante-pago-'.$payment->getId().'.pdf');
    }
}
