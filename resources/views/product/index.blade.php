{{-- Edited by Mariana Carrasquilla --}}
@extends('layouts.app')
@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h2 class="mb-3">{{ $viewData['subtitle'] }}</h2>

  <form method="GET" action="{{ route('product.index') }}" class="row g-2 mb-4">
    <div class="col-md-5">
      <input
        type="text"
        name="search"
        class="form-control"
        value="{{ $viewData['search'] ?? '' }}"
        placeholder="{{ __('product.search_placeholder') }}"
      >
    </div>
    <div class="col-md-5">
      <select name="category_id" class="form-select">
        <option value="">{{ __('product.all_categories') }}</option>
        @foreach(($viewData['categories'] ?? []) as $category)
          <option value="{{ $category->id }}" @selected(($viewData['selectedCategory'] ?? null) == $category->id)>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2 d-grid">
      <button class="btn btn-primary" type="submit">{{ __('product.actions.search') }}</button>
    </div>
  </form>

  <div class="row g-3">
    @forelse($viewData['products'] as $product)
      <div class="col-md-4">
        <div class="card h-100">
          @if($product->getImage())
            <img src="{{ $product->getImageUrl() }}" class="card-img-top" alt="{{ $product->getName() }}" style="height:200px;object-fit:cover;">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $product->getName() }}</h5>
            <p class="card-text mb-1">{{ __('product.labels.price') }}: ${{ number_format($product->getPrice(), 0, ',', '.') }}</p>
            <p class="card-text">{{ __('product.labels.stock') }}: {{ $product->getStock() }}</p>
            <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-primary btn-sm">{{ __('product.actions.view') }}</a>
            <form action="{{ route('cart.add', $product->getId()) }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-primary btn-sm" type="submit">{{ __('product.actions.add') }}</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted">{{ __('product.empty') }}</p>
    @endforelse
  </div>
</div>
@endsection