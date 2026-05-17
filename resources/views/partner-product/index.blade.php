@extends('layouts.app')
@section('title', __('partner.title'))

@section('content')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark mb-0">
      {{ __('partner.subtitle') }} - <span id="store-name" class="text-primary">{{ __('partner.default_store') }}</span>
    </h2>
  </div>

  <div id="partner-data" 
    data-api-url="http://34.63.29.192/api/products"
    data-empty="{{ __('partner.empty') }}"
    data-no-name="{{ __('partner.no_name') }}"
    data-price="{{ __('partner.price') }}"
    data-category="{{ __('partner.category') }}"
    data-stock="{{ __('partner.stock') }}"
    data-view-in-store="{{ __('partner.view_in_store') }}"
    data-error="{{ __('partner.error') }}"
  ></div>

  <div class="row g-4" id="products-container">
  </div>
</div>

<script src="{{ asset('js/partner.js') }}"></script>
@endsection
