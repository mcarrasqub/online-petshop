{{-- edited by Antigravity --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0">{{ __('orders.heading_show') }} #{{ $viewData['order']->getId() }}</h1>
                    <a href="{{ route('orders.list') }}" class="btn btn-sm btn-outline-secondary">
                        {{ __('orders.btn_back') }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-2">{{ __('orders.my.date') }}</h6>
                            <p class="fw-bold">{{ substr($viewData['order']->getCreatedAt(), 0, 16) }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted mb-2">{{ __('orders.fields.status') }}</h6>
                            <span class="badge bg-info text-dark">{{ __('orders.status.' . $viewData['order']->getStatus()) }}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="text-muted mb-2">{{ __('orders.fields.address') }}</h6>
                            <p>{{ $viewData['order']->getAddress() }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted mb-2">{{ __('orders.fields.total') }}</h6>
                            <p class="h4 text-primary fw-bold">${{ number_format($viewData['order']->getTotal(), 2) }}</p>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-4">{{ __('cart.labels.product') }}s</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 100px;">{{ __('cart.labels.product') }}</th>
                                    <th></th>
                                    <th class="text-center">{{ __('cart.labels.price') }}</th>
                                    <th class="text-center">{{ __('cart.labels.quantity') }}</th>
                                    <th class="text-end">{{ __('cart.labels.subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['order']->getOrderItems() as $item)
                                    <tr>
                                        <td>
                                            @if($item->getProduct()->getImageUrl())
                                                <img src="{{ $item->getProduct()->getImageUrl() }}" alt="{{ $item->getProduct()->getName() }}" class="img-fluid rounded" style="max-height: 80px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('product.show', $item->getProduct()->getId()) }}" class="text-decoration-none fw-bold text-dark">
                                                {{ $item->getProduct()->getName() }}
                                            </a>
                                        </td>
                                        <td class="text-center">${{ number_format($item->getPrice(), 2) }}</td>
                                        <td class="text-center">{{ $item->getUnits() }}</td>
                                        <td class="text-end fw-bold">${{ number_format($item->getSubtotal(), 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
