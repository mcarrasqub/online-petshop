<?php

// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ORDER ITEMS ATTRIBUTES
 * $this->attributes['id'] - int - contains the order item primary key (id)
 * $this->attributes['units'] - int - contains the order item units
 * $this->attributes['price'] - float - contains the order item price
 * $this->attributes['subtotal'] - float - contains the order item subtotal
 * $this->attributes['product_id'] - int - contains the product primary key (id)
 * $this->attributes['order_id'] - int - contains the order primary key (id)
 * $this->attributes['created_at'] - datetime - contains the order item creation date
 * $this->attributes['updated_at'] - datetime - contains the order item update date
 *
 * RELATIONSHIPS
 * $this->product - Product - contains the order item product
 * $this->order - Order - contains the order item order
 */
class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'units',
        'price',
        'subtotal',
        'product_id',
        'order_id',
        'created_at',
        'updated_at',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUnits(): int
    {
        return $this->attributes['units'];
    }

    public function setUnits(int $units): void
    {
        $this->attributes['units'] = $units;
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getSubtotal(): float
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal(float $subtotal): void
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product()->associate($product);
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order()->associate($order);
    }
}
