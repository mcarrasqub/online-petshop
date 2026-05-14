<?php

// Edited by David García Zapata

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    public function createFromCart(int $userId, string $address, array $cart): Order
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'pending',
            'address' => $address,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'units' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
                'order_id' => $order->getId(),
                'product_id' => $productId,
            ]);
        }

        return $order;
    }
}
