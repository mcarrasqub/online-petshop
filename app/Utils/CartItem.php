<?php

namespace App\Utils;

use App\Models\Product;

class CartItem
{
    private Product $product;

    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->product->getName();
    }

    public function getPrice(): float
    {
        return $this->product->getPrice();
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSubtotal(): float
    {
        return $this->getPrice() * $this->getQuantity();
    }

    public function getImage(): ?string
    {
        return $this->product->getImageUrl();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
