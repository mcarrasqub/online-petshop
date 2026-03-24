<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ __('payment.receipt.title') }}</title>
    <link rel="stylesheet" href="{{ public_path('css/receipt.css') }}" type="text/css">
</head>
<body>
    @php
        $methodKey = 'payment.methods.'.$payment->method;
        $methodLabel = __($methodKey);
    @endphp
    <div class="header">
        <h1 class="title">{{ __('payment.receipt.title') }}</h1>
        <div class="subtitle">{{ __('payment.receipt.store_name') }}</div>
    </div>

    <div class="card">
        <div class="row"><span class="label">{{ __('payment.receipt.payment_number') }}</span><span class="value">{{ $payment->id }}</span></div>
        <div class="row"><span class="label">{{ __('payment.receipt.payment_date') }}</span><span class="value">{{ $payment->date }}</span></div>
        <div class="row"><span class="label">{{ __('payment.fields.method') }}</span><span class="value">{{ $methodLabel === $methodKey ? $payment->method : $methodLabel }}</span></div>
        <div class="row"><span class="label">{{ __('payment.fields.amount') }}</span><span class="value">${{ number_format($payment->amount, 2) }}</span></div>
    </div>

    <div class="card">
        <div class="row"><span class="label">{{ __('payment.fields.order_number') }}</span><span class="value">{{ $payment->order?->id }}</span></div>
        <div class="row"><span class="label">{{ __('payment.receipt.customer') }}</span><span class="value">{{ $payment->order?->user?->name }}</span></div>
        <div class="row"><span class="label">{{ __('payment.receipt.email') }}</span><span class="value">{{ $payment->order?->user?->email }}</span></div>
        <div class="row"><span class="label">{{ __('payment.fields.address') }}</span><span class="value">{{ $payment->order?->address }}</span></div>
        <div class="row"><span class="label">{{ __('payment.fields.status') }}</span><span class="value">{{ __('orders.status.' . $payment->order?->status) }}</span></div>
    </div>

    <div class="footer">
        {{ __('payment.receipt.generated_at', ['date' => now()->format('Y-m-d H:i:s')]) }}
    </div>
</body>
</html>
