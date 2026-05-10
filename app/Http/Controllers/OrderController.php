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

    public function list(): View
    {
        $viewData = [];
        $viewData['title'] = __('orders.my.title');
        $viewData['orders'] = Order::getByUser(Auth::id());

        return view('orders.list')->with('viewData', $viewData);
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $cart = $request->session()->get('cart', []);

        $order = Order::createFromCart(Auth::id(), $validated['address'], $cart);

        return redirect()->route('payment.index', $order->id);
    }

    public function show(string $id): View
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('orders.title_show');
        $viewData['order'] = $order;

        return view('orders.show')->with('viewData', $viewData);
    }
}
