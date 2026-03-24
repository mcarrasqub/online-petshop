<?php

// edited by David Garcia Zapata

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('cart.title_index');
        $viewData['subtitle'] = __('cart.subtitle_index');
        $viewData['cart'] = Cart::getCart();
        $viewData['total'] = Cart::getTotal();

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(CartRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        Cart::add($product);

        return redirect()->back()->with('success', __('cart.messages.added'));
    }

    public function remove(int $id): RedirectResponse
    {
        Cart::remove($id);

        return redirect()->route('cart.index')->with('success', __('cart.messages.removed'));
    }

    public function removeAll(): RedirectResponse
    {
        Cart::clear();

        return redirect()->route('cart.index')->with('success', __('cart.messages.cleared'));
    }
}
