<?php
// Edited by Sofia Gallo

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * PAYMENT ATTRIBUTES
     * $this->attributes['id'] - int - contains the payment primary key (id)
     * $this->attributes['amount'] - int - contains the payment amount
     * $this->attributes['date'] - date - contains the payment date
     * $this->attributes['method'] - string - contains the payment method
     * $this->attributes['order_id'] - int - contains the order primary key (id)
     * $this->attributes[timestamps] - timestamp - contains the payment created_at and updated_at timestamps
     */
    protected $fillable = ['amount', 'date', 'method', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getAmount(): int
    {
        return $this->attributes['amount'];
    }

    public function setAmount(int $amount): void
    {
        $this->attributes['amount'] = $amount;
    }

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getMethod(): string
    {
        return $this->attributes['method'];
    }

    public function setMethod(string $method): void
    {
        $this->attributes['method'] = $method;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }
}
