<?php

namespace App\Interfaces;

use App\Models\Payment;
use Illuminate\Http\Response;

// modified by Sofia Gallo

interface PaymentReceiptGeneratorInterface
{
    /**
     * Generate a payment receipt.
     */
    public function generate(Payment $payment): Response;
}
