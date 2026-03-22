@extends('layouts.app')
//edited by David Garcia Zapata
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
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
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
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>${{ number_format($viewData['total'], 2) }}</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.removeAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Clear Cart</button>
            </form>
            <a href="{{ route('product.index') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary">Continue Shopping</a>
    @endif
</div>
@endsection
