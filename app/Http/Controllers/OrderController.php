<?php
// Edited by David García Zapata

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        return View('orders.create');
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
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
