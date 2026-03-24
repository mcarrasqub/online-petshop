{{-- edited by David Garcia Zapata --}}
@extends('layouts.app')

@section('title', __('orders.checkout.title'))

@section('content')
  <div class="card shadow-sm border-0 mx-auto" style="max-width: 760px;">
    <div class="card-header bg-white py-3">
      <h1 class="h4 mb-0">{{ __('orders.checkout.title') }}</h1>
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

      <p class="mb-3 text-muted">{{ __('orders.checkout.subtitle') }}</p>

      <div class="mb-4">
        <h2 class="h6">{{ __('orders.checkout.contact_data') }}</h2>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between"><span>{{ __('orders.checkout.name') }}</span><strong>{{ $viewData['user']->getName() }}</strong></li>
          <li class="list-group-item d-flex justify-content-between"><span>{{ __('orders.checkout.email') }}</span><strong>{{ $viewData['user']->getEmail() }}</strong></li>
          <li class="list-group-item d-flex justify-content-between"><span>{{ __('orders.checkout.phone') }}</span><strong>{{ $viewData['user']->getPhoneNumber() ?: __('orders.checkout.not_registered') }}</strong></li>
          <li class="list-group-item d-flex justify-content-between"><span>{{ __('orders.checkout.order_total') }}</span><strong>${{ number_format($viewData['total'], 2) }}</strong></li>
        </ul>
      </div>

      <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="address" class="form-label">{{ __('orders.checkout.shipping_address') }}</label>
          <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="1" id="confirm_contact" name="confirm_contact" {{ old('confirm_contact') ? 'checked' : '' }}>
          <label class="form-check-label" for="confirm_contact">
            {{ __('orders.checkout.confirm_contact') }}
          </label>
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">{{ __('orders.checkout.back_to_cart') }}</a>
          <button type="submit" class="btn btn-primary">{{ __('orders.checkout.continue_to_payment') }}</button>
        </div>
      </form>
    </div>
  </div>
@endsection
