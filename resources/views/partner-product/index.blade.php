@extends('layouts.app')
@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h2 class="mb-3">{{ $viewData['subtitle'] }} - {{ $viewData['storeName'] }}</h2>

  <div class="row g-3">
    @forelse($viewData['products'] as $product)
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{ $product['title'] ?? __('partner.no_name') }}</h5>
            <p class="card-text mb-1">{{ __('partner.price') }}: ${{ isset($product['price']) ? number_format($product['price'], 0, ',', '.') : '0' }}</p>
            <p class="card-text mb-1">{{ __('partner.category') }}: {{ $product['category'] ?? 'N/A' }}</p>
            <p class="card-text mb-3">{{ __('partner.stock') }}: {{ $product['stock'] ?? 0 }}</p>
            @if(isset($product['links']['view']))
              <a href="{{ $product['links']['view'] }}" target="_blank" class="btn btn-outline-primary btn-sm">{{ __('partner.view_in_store') }}</a>
            @endif
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted">{{ __('partner.empty') }}</p>
    @endforelse
  </div>
</div>
@endsection
