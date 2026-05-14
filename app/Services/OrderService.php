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
            $total += $item->getSubtotal();
        }

        $order = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'pending',
            'address' => $address,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'units' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'subtotal' => $item->getSubtotal(),
                'order_id' => $order->getId(),
                'product_id' => $productId,
            ]);
        }

        return $order;
    }
}
