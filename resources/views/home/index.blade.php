@extends('layouts.app')

@section('content')


<div class="container py-4">
    <div class="hero-section">
        <i class="bi bi-heart-fill hero-bg-icon"></i>
        <h1 class="display-4 fw-bold">{{ __('ui.welcome_to_huellitas') }}</h1>
        <p class="lead fw-medium">{{ __('ui.find_your_best_friend') }}</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('product.index') }}" class="btn btn-light btn-lg rounded-pill fw-bold px-4 py-2 shadow-sm text-app-brand">
                <i class="bi bi-shop me-2"></i> {{ __('ui.explore_products') }}
            </a>
            @guest
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg rounded-pill fw-bold px-4 py-2 border-2">
                {{ __('ui.join_now') }}
            </a>
            @endguest
        </div>
    </div>

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-bag-heart feature-icon"></i>
                <h3 class="h5 fw-bold">{{ __('ui.quality_products') }}</h3>
                <p class="text-muted">{{ __('ui.quality_products_desc') }}</p>
                <a href="{{ route('product.index') }}" class="btn rounded-pill mt-3 fw-bold btn-outline-app-brand">{{ __('ui.view_catalog') }}</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-stars feature-icon text-app-warning"></i>
                <h3 class="h5 fw-bold">{{ __('ui.allied_products') }}</h3>
                <p class="text-muted">{{ __('ui.allied_products_desc') }}</p>
                <a href="{{ route('api.partner.product.index') }}" class="btn rounded-pill mt-3 fw-bold btn-outline-app-warning">{{ __('ui.view_allies') }}</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <i class="bi bi-box-seam feature-icon text-success"></i>
                <h3 class="h5 fw-bold">{{ __('ui.fast_shipping') }}</h3>
                <p class="text-muted">{{ __('ui.fast_shipping_desc') }}</p>
                @auth
                    <a href="{{ route('orders.list') }}" class="btn btn-outline-success rounded-pill mt-3 fw-bold">{{ __('ui.my_orders') }}</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success rounded-pill mt-3 fw-bold">{{ __('ui.login') }}</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
