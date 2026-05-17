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

    public function decreaseStockFromOrder(int $orderId): void
    {
        $order = Order::findOrFail($orderId);
        $orderItems = $order->orderItems()->with('product')->get();

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->getProduct();
            $newStock = max(0, $product->getStock() - $orderItem->getUnits());
            $product->setStock($newStock);
            $product->save();
        }
    }
}

