<?php

// Edited by David García Zapata adn Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['total'] = Cart::getTotal();
        $viewData['user'] = Auth::user();

        return view('orders.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return View('orders.create');
    }

    public function myOrders(): View
    {
        $orders = Order::with('payment')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my', compact('orders'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => Cart::getTotal(),
            'status' => 'pending',
            'address' => $validated['address'],
        ]);

        Cart::clear();

        return redirect()->route('payment.index', $order->id);
    }

    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        $validated = $request->validated();

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
