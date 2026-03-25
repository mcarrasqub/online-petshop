<?php

// Edited by David García Zapata adn Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $viewData = [];
        $viewData['total'] = $total;
        $viewData['user'] = Auth::user();

        return view('orders.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return View('orders.create');
    }

    public function myOrders(): View
    {
        $orders = Order::getByUser(Auth::id());

        return view('orders.my', compact('orders'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $cart = $request->session()->get('cart', []);

        $order = Order::createFromCart(Auth::id(), $validated['address'], $cart);

        return redirect()->route('payment.index', $order->id);
    }

    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }
}
