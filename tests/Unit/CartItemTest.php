<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Utils\CartItem;
use Tests\TestCase;

class CartItemTest extends TestCase
{
    public function test_cart_item_calculates_subtotal_correctly(): void
    {
        $productMock = $this->createMock(Product::class);
        $productMock->method('getName')->willReturn('Juguete para Perro');
        $productMock->method('getPrice')->willReturn(15000.00);
        $productMock->method('getImageUrl')->willReturn('https://storage.googleapis.com/test-bucket/toy.png');

        $cartItem = new CartItem($productMock, 3);

        $this->assertEquals('Juguete para Perro', $cartItem->getName());
        $this->assertEquals(15000.00, $cartItem->getPrice());
        $this->assertEquals(3, $cartItem->getQuantity());
        $this->assertEquals(45000.00, $cartItem->getSubtotal());
        $this->assertEquals('https://storage.googleapis.com/test-bucket/toy.png', $cartItem->getImage());
    }
}
