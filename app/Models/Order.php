<?php
// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ORDERS ATTRIBUTES
 * $this->attributes['id'] - int - contains the order primary key (id)
 * $this->attributes['total'] - float - contains the order total amount
 * $this->attributes['status'] - string - contains the order status
 * $this->attributes['user_id'] - int - contains the user primary key (id)  
 * $this->attributes['created_at'] - datetime - contains the order creation date
 * $this->attributes['updated_at'] - datetime - contains the order update date
 */

class Order extends Model
{

    protected $fillable = [
        'total',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    // Setters

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setUser($user)
    {
        $this->user()->associate($user);
    }


    // Custom Methods
    public function calculateTotal()
    {
        $total = 0;
        if ($this->orderItems) {
            foreach ($this->orderItems as $item) {
                // Assuming OrderItem has a getTotal() or price * quantity logic
                // $total += $item->getTotal();
            }
        }
        $this->total = $total;

        return $this->total;
    }

    public function confirm()
    {
        $this->status = 'Confirmed';
        $this->save();
    }

    public function cancel()
    {
        $this->status = 'Canceled';
        $this->save();
    }
}
