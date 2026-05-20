<?php

// modified by Sofia Gallo

namespace App\Services\Receipts;

use App\Interfaces\PaymentReceiptGeneratorInterface;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfPaymentReceiptGeneratorService implements PaymentReceiptGeneratorInterface
{
    public function generate(Payment $payment): Response
    {
        $pdf = Pdf::loadView('payment.receipt', [
            'payment' => $payment,
        ]);

        return $pdf->download('comprobante-pago-'.$payment->getId().'.pdf');
    }
}
