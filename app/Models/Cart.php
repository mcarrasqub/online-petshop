<?php

// edited by David Garcia Zapata

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Cart
{
    public static function getCart()
    {
        return Session::get('cart', []);
    }

    public static function getTotal()
    {
        $cart = self::getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    public static function add(Product $product)
    {
        $cart = self::getCart();
        $id = $product->getId();

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->getName(),
                'quantity' => 1,
                'price' => $product->getPrice(),
                'image' => $product->getImage(),
            ];
        }

        Session::put('cart', $cart);
    }

    public static function remove($id)
    {
        $cart = self::getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    public static function clear()
    {
        Session::forget('cart');
    }
}
