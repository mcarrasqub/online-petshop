<?php

namespace App\Interfaces;

use App\Models\Payment;
use \Illuminate\Http\Response;


//modified by Sofia Gallo

interface PaymentReceiptGeneratorInterface
{
    /**
     * Generate a payment receipt.
     * 
     * @param Payment $payment
     * @return Response
     */
    public function generate(Payment $payment): Response;
}
