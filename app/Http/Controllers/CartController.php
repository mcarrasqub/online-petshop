<?php

// edited by David Garcia Zapata

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $viewData = [];
        $viewData['title'] = __('cart.title_index');
        $viewData['subtitle'] = __('cart.subtitle_index');
        $viewData['cart'] = $cart;
        $viewData['total'] = $total;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(CartRequest $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->getName(),
                'quantity' => 1,
                'price' => $product->getPrice(),
                'image_url' => $product->getImageUrl(),
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', __('cart.messages.added'));
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', __('cart.messages.removed'));
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return redirect()->route('cart.index')->with('success', __('cart.messages.cleared'));
    }
}
