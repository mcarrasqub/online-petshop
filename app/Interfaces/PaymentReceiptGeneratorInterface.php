<?php

namespace App\Interfaces;

use App\Models\Payment;


//modified by Sofia Gallo

interface PaymentReceiptGeneratorInterface
{
    /**
     * Generate a payment receipt.
     * 
     * @param Payment $payment
     * @return mixed 
     */
    public function generate(Payment $payment): mixed;
}
