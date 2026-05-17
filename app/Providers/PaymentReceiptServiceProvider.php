<?php

// modified by Sofia Gallo

namespace App\Providers;

use App\Interfaces\PaymentReceiptGeneratorInterface;
use App\Services\Receipts\ImagePaymentReceiptGenerator;
use App\Services\Receipts\PdfPaymentReceiptGenerator;
use Illuminate\Support\ServiceProvider;

class PaymentReceiptServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentReceiptGeneratorInterface::class, function ($app) {
            $format = $app->make('request')->query('format');

            if ($format === 'image') {
                return new ImagePaymentReceiptGenerator;
            }

            return new PdfPaymentReceiptGenerator;
        });
    }

    public function boot(): void
    {
        //
    }
}
