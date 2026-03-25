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
    public function index(Order $order): View
    {
        $order->load('user');

        return view('payment.index', compact('order'));
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $payment = Payment::create($request->validated());

        return redirect()->route('payment.success', $payment);

    }

    public function success(Payment $payment): View
    {
        $payment->load('order');

        return view('payment.success', compact('payment'));
    }

    public function receipt(Payment $payment)
    {
        $payment->load('order.user');

        $pdf = Pdf::loadView('payment.receipt', compact('payment'));

        return $pdf->download('comprobante-pago-'.$payment->id.'.pdf');
    }

}
