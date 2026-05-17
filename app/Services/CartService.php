<?php

// Edited by David García Zapata

namespace App\Services;

use App\Models\Product;
use App\Utils\CartItem;
use Illuminate\Http\Request;

class CartService
{
    public function getCart(Request $request): array
    {
        $cartData = $request->session()->get('cart', []);
        $ids = array_keys($cartData);

        if (empty($ids)) {
            return [];
        }

        $products = Product::whereIn('id', $ids)->get()->keyBy('id');
        $cartItems = [];

        foreach ($cartData as $id => $item) {
            if (isset($products[$id])) {
                $cartItems[$id] = new CartItem($products[$id], $item['quantity']);
            }
        }

        return $cartItems;
    }

    public function calculateTotal(Request $request): float|int
    {
        $cart = $this->getCart($request);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item->getSubtotal();
        }

        return $total;
    }

    public function add(Request $request, int $id): void
    {
        $product = Product::findOrFail($id);

        if ($product->getStock() <= 0) {
            return;
        }

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
    }

    public function decrease(Request $request, int $id): void
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            $request->session()->put('cart', $cart);
        }
    }

    public function remove(Request $request, int $id): void
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }
    }

    public function removeAll(Request $request): void
    {
        $request->session()->forget('cart');
    }
}
