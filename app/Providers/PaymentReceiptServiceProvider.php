<?php

// modified by Sofia Gallo

namespace App\Providers;

use App\Interfaces\PaymentReceiptGeneratorInterface;
use App\Services\Receipts\ImagePaymentReceiptGeneratorService;
use App\Services\Receipts\PdfPaymentReceiptGeneratorService;
use Illuminate\Support\ServiceProvider;

class PaymentReceiptServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentReceiptGeneratorInterface::class, function ($app) {
            $format = $app->make('request')->query('format');

            if ($format === 'image') {
                return new ImagePaymentReceiptGeneratorService;
            }

            return new PdfPaymentReceiptGeneratorService;
        });
    }

    public function boot(): void
    {
        //
    }
}
