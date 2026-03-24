{{-- edited by David Garcia Zapata --}}
@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>{{ __('cart.nav_cart') }}</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(count($viewData['cart']) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('cart.labels.product') }}</th>
                    <th>{{ __('cart.labels.price') }}</th>
                    <th>{{ __('cart.labels.quantity') }}</th>
                    <th>{{ __('cart.labels.subtotal') }}</th>
                    <th>{{ __('cart.labels.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['cart'] as $id => $item)
                    <tr>
                        <td>
                            @if(isset($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px; object-fit: cover;" class="me-2">
                            @endif
                            {{ $item['name'] }}
                        </td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('cart.labels.remove') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>{{ __('cart.labels.total') }}:</strong></td>
                    <td><strong>${{ number_format($viewData['total'], 2) }}</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.removeAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">{{ __('cart.labels.clear_cart') }}</button>
            </form>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Generar orden</a>
        </div>
    @else
        <p>{{ __('cart.labels.empty_cart') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary">{{ __('cart.labels.continue_shopping') }}</a>
    @endif
</div>
@endsection
