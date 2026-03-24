{{-- edited by Sofia Gallo --}}
@extends('layouts.app')

@section('title', __('payment.checkout.title'))

@section('content')
<div class="card shadow-sm border-0 mx-auto" style="max-width: 760px;">
    <div class="card-header bg-white py-3">
        <h1 class="h4 mb-0">{{ __('payment.checkout.title') }}</h1>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <h2 class="h6">{{ __('payment.checkout.order_summary') }}</h2>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.checkout.order') }}</span><strong>#{{ $order->id }}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.checkout.customer') }}</span><strong>{{ $order->user->name }}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.total') }}</span><strong>${{ number_format($order->total, 2) }}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span>{{ __('payment.fields.address') }}</span><strong>{{ $order->address }}</strong></li>
            </ul>
        </div>

        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="amount" value="{{ $order->total }}">
            <input type="hidden" name="date" value="{{ now()->toDateString() }}">

            <div class="mb-3">
                <label for="method" class="form-label">{{ __('payment.checkout.payment_method') }}</label>
                <select id="method" name="method" class="form-select" required>
                    <option value="">{{ __('payment.checkout.select_method') }}</option>
                    <option value="pse" {{ old('method') === 'pse' ? 'selected' : '' }}>{{ __('payment.methods.pse') }}</option>
                    <option value="credit_card" {{ old('method') === 'credit_card' ? 'selected' : '' }}>{{ __('payment.methods.credit_card') }}</option>
                    <option value="debit_card" {{ old('method') === 'debit_card' ? 'selected' : '' }}>{{ __('payment.methods.debit_card') }}</option>
                    <option value="nequi" {{ old('method') === 'nequi' ? 'selected' : '' }}>{{ __('payment.methods.nequi') }}</option>
                    <option value="daviplata" {{ old('method') === 'daviplata' ? 'selected' : '' }}>{{ __('payment.methods.daviplata') }}</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="1" id="confirm_payment" name="confirm_payment" {{ old('confirm_payment') ? 'checked' : '' }}>
                <label class="form-check-label" for="confirm_payment">
                    {{ __('payment.checkout.confirm_payment') }}
                </label>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">{{ __('payment.checkout.back') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('payment.checkout.confirm') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
