<?php

// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * ORDER ITEMS ATTRIBUTES
 * $this->attributes['id'] - int - contains the order item primary key (id)
 * $this->attributes['units'] - int - contains the order item units
 * $this->attributes['price'] - float - contains the order item price
 * $this->attributes['subtotal'] - float - contains the order item subtotal
 * $this->attributes['order_id'] - int - contains the order primary key (id)
 * $this->attributes['product_id'] - int - contains the product primary key (id)
 * $this->attributes['created_at'] - datetime - contains the order item creation date
 * $this->attributes['updated_at'] - datetime - contains the order item update date
 */
class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'units',
        'price',
        'subtotal',
        'order_id',
        'product_id',
        'created_at',
        'updated_at',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUnits(): int
    {
        return $this->units;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function setUnits(int $units): void
    {
        $this->units = $units;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    public function setOrder(Order $order): void
    {
        $this->order()->associate($order);
    }

    public function setProduct(Product $product): void
    {
        $this->product()->associate($product);
    }
}
