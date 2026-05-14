<?php

// Edited by David García Zapata

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    public function calculateTotal(Request $request): float|int
    {
        $cart = $this->getCart($request);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public function add(Request $request, int $id): void
    {
        $product = Product::findOrFail($id);
        $cart = $this->getCart($request);

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
        $cart = $this->getCart($request);

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
        $cart = $this->getCart($request);

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
