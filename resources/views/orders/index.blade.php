//edited by David Garcia Zapata
@extends('layouts.app')

@section('title', __('orders.title_index'))

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h1 class="h3 mb-0 text-gray-800">{{ __('orders.heading_index') }}</h1>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('orders.fields.id') }}</th>
                            <th>{{ __('orders.fields.user_id') }}</th>
                            <th>{{ __('orders.fields.total_price') }}</th>
                            <th>{{ __('orders.fields.status') }}</th>
                            <th class="text-end">{{ __('orders.fields.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <span @class([
                                        'badge',
                                        'bg-success' => $order->status === 'completed',
                                        'bg-danger' => $order->status === 'cancelled',
                                        'bg-warning text-dark' => $order->status !== 'completed' && $order->status !== 'cancelled',
                                    ])>
                                        {{ __('orders.status.' . $order->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-info">{{ __('orders.btn_view') }}</a>
                                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-outline-warning">{{ __('orders.btn_edit') }}</a>
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('orders.confirm_delete') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('orders.btn_delete') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">{{ __('orders.no_orders') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
