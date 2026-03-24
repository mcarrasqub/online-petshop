{{-- edited by Sofia Gallo --}}
@extends('layouts.app')

@section('title', __('orders.my.title'))

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0">{{ __('orders.my.title') }}</h1>
        <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-primary">{{ __('orders.my.continue_shopping') }}</a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('orders.fields.total') }}</th>
                        <th>{{ __('orders.fields.status') }}</th>
                        <th>{{ __('orders.fields.address') }}</th>
                        <th>{{ __('orders.my.payment') }}</th>
                        <th>{{ __('orders.my.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ __('orders.status.' . $order->status) }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                @if($order->payment)
                                    <span class="badge bg-success">{{ __('orders.my.paid') }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ __('orders.my.pending_payment') }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at?->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">{{ __('orders.my.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
