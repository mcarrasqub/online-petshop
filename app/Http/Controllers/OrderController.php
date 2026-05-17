<?php

// Edited by David García Zapata and Sofia Gallo

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly CartService $cartService
    ) {}

    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['total'] = $this->cartService->calculateTotal($request);
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

        $cart = $this->cartService->getCart($request);

        $order = $this->orderService->createFromCart(Auth::id(), $validated['address'], $cart);

        return redirect()->route('payment.index', $order->getId());
    }

    public function show(int $id): View
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('orders.title_show');
        $viewData['order'] = $order;

        return view('orders.show')->with('viewData', $viewData);
    }
}
