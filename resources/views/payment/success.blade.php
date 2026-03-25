
{{-- Edited by Sofia Gallo --}} 

@extends('layouts.app')

@section('title', __('payment.title_success'))

@section('content')
<div class="card shadow-sm border-0">
  <div class="card-header bg-white py-3">
    <h1 class="h4 mb-0 text-success">{{ __('payment.heading_success') }}</h1>
  </div>

  <div class="card-body">
    <p class="mb-4">{{ __('payment.message_success') }}</p>

    <h2 class="h5">{{ __('payment.section_payment') }}</h2>
    @php
      $methodKey = 'payment.methods.'.$payment->getMethod();
      $methodLabel = __($methodKey);
    @endphp
    <ul class="list-group mb-4">
      <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.id') }}</span><strong>{{ $payment->getId() }}</strong></li>
      <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.amount') }}</span><strong>${{ number_format($payment->getAmount(), 2) }}</strong></li>
      <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.date') }}</span><strong>{{ $payment->getDate() }}</strong></li>
      <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.method') }}</span><strong>{{ $methodLabel === $methodKey ? $payment->getMethod() : $methodLabel }}</strong></li>
    </ul>

    <h2 class="h5">{{ __('payment.section_order') }}</h2>
    @if($payment->getOrder())
      <ul class="list-group mb-4">
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.order_number') }}</span><strong>{{ $payment->getOrder()->getId() }}</strong></li>
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.total') }}</span><strong>${{ number_format($payment->getOrder()->getTotal(), 2) }}</strong></li>
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.status') }}</span><strong>{{ __('orders.status.' . $payment->getOrder()->getStatus()) }}</strong></li>
        <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.address') }}</span><strong>{{ $payment->getOrder()->getAddress() }}</strong></li>
      </ul>
    @else
      <div class="alert alert-warning">{{ __('payment.order_not_found') }}</div>
    @endif

    <div class="d-flex gap-2">
      <a href="{{ route('payment.receipt', $payment) }}" class="btn btn-success">{{ __('payment.btn_download_receipt') }}</a>
      <a href="{{ route('orders.my') }}" class="btn btn-primary">{{ __('payment.btn_view_orders') }}</a>
      <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('payment.btn_go_home') }}</a>
    </div>
  </div>
</div>
@endsection
