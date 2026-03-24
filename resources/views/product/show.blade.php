{{-- Edited by Mariana Carrasquilla --}}
@extends('layouts.app')
@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm mb-3">{{ __('product.actions.back') }}</a>

  <div class="card">
    <div class="row g-0">
      <div class="col-md-4">
        @if($viewData['product']->getImage())
          <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start" alt="{{ $viewData['product']->getName() }}">
        @else
          <div class="p-4 text-muted">{{ __('product.no_image') }}</div>
        @endif
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h4 class="card-title">{{ $viewData['product']->getName() }}</h4>
          <p class="card-text">{{ $viewData['product']->getDescription() }}</p>
          <p class="card-text mb-1">{{ __('product.labels.price') }}: ${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }}</p>
          <p class="card-text mb-3">{{ __('product.labels.stock') }}: {{ $viewData['product']->getStock() }}</p>

          <form action="{{ route('cart.add', $viewData['product']->getId()) }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">{{ __('product.actions.add_to_cart') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection