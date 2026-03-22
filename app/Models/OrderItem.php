<?php

// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUnits()
    {
        return $this->units;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUnits(int $units)
    {
        $this->units = $units;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function setSubtotal(int $subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function setOrder($order)
    {
        $this->order()->associate($order);
    }

    public function setProduct($product)
    {
        $this->product()->associate($product);
    }
}
