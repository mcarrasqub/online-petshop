<?php

// modified by Sofia Gallo

namespace App\Services\Receipts;

use App\Interfaces\PaymentReceiptGeneratorInterface;
use App\Models\Payment;
use Illuminate\Http\Response as HttpResponse;
use Intervention\Image\Geometry\Factories\RectangleFactory;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Typography\FontFactory;

class ImagePaymentReceiptGenerator implements PaymentReceiptGeneratorInterface
{
    private int $width = 700;

    private int $height = 450;

    private int $padding = 20;

    public function generate(Payment $payment): HttpResponse
    {
        $order = $payment->getOrder();
        $user = $order?->getUser();

        $image = Image::create($this->width, $this->height)
            ->fill('ffffff');

        // Header design
        $image->drawRectangle(0, 0, function (RectangleFactory $r) {
            $r->size($this->width, 90);
            $r->background('0a416e');
        });

        // Outer border
        $image->drawRectangle(10, 10, function (RectangleFactory $r) {
            $r->size($this->width - 20, $this->height - 20);
            $r->border('5a5a5a', 1);
        });

        // Header text
        $image->text(__('payment.receipt.store_name'), $this->padding, 40, $this->font('ffffff', 18));
        $image->text(__('payment.receipt.title'), $this->padding, 70, $this->font('ffffff', 14));

        // Payment data
        $y = 120;
        $gap = 28;

        $image->text(__('payment.receipt.payment_number').': '.$payment->getId(), $this->padding, $y += 0, $this->font('000000', 13));
        $image->text(__('payment.receipt.payment_date').': '.$payment->getDate(), $this->padding, $y += $gap, $this->font('000000', 13));
        $image->text(__('payment.fields.amount').': $'.number_format($payment->getAmount(), 2), $this->padding, $y += $gap, $this->font('000000', 13));
        $image->text(__('payment.fields.method').': '.$payment->getMethod(), $this->padding, $y += $gap, $this->font('000000', 13));

        // Customer data
        if ($user) {
            $y += (int) ($gap * 1.5);
            $image->text(__('payment.receipt.customer').': '.$user->getName(), $this->padding, $y, $this->font('5a5a5a', 13));
            $image->text(__('payment.receipt.email').': '.$user->getEmail(), $this->padding, $y += $gap, $this->font('5a5a5a', 13));
        }

        // Order data
        if ($order) {
            $y += (int) ($gap * 1.5);
            $image->text(__('payment.section_order').':', $this->padding, $y, $this->font('000000', 13));

            $image->text(__('payment.fields.order_number').': '.$order->getId(), $this->padding + 10, $y += $gap, $this->font('5a5a5a', 12));
            $image->text(__('payment.fields.total').': $'.number_format($order->getTotal(), 2), $this->padding + 10, $y += $gap, $this->font('5a5a5a', 12));
            $image->text(__('payment.fields.status').': '.__('orders.status.'.$order->getStatus()), $this->padding + 10, $y += $gap, $this->font('5a5a5a', 12));
            $image->text(__('payment.fields.address').': '.$order->getAddress(), $this->padding + 10, $y += $gap, $this->font('5a5a5a', 12));
        }

        $encoded = $image->toPng();

        return response((string) $encoded, 200)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="comprobante-pago-'.$payment->getId().'.png"');
    }

    private function font(string $color, int $size): \Closure
    {
        return function (FontFactory $font) use ($color, $size) {
            $font->filename(public_path('fonts/Roboto-Regular.ttf'));
            $font->color($color);
            $font->size($size);
        };
    }
}
