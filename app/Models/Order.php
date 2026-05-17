<?php

// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * ORDERS ATTRIBUTES
 * $this->attributes['id'] - int - contains the order primary key (id)
 * $this->attributes['total'] - int - contains the order total amount
 * $this->attributes['status'] - string - contains the order status
 * $this->attributes['address'] - string - contains the order shipping address
 * $this->attributes['user_id'] - int - contains the user primary key (id)
 * $this->attributes['created_at'] - datetime - contains the order creation date
 * $this->attributes['updated_at'] - datetime - contains the order update date
 *
 * RELATIONSHIPS
 * $this->user - User - contains the order user
 * $this->orderItems - OrderItem[] - contains the order items
 * $this->payment - Payment - contains the order payment
 */
class Order extends Model
{
    protected $fillable = [
        'total',
        'status',
        'address',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user()->associate($user);
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function confirm(): void
    {
        $this->attributes['status'] = 'Confirmed';
        $this->save();
    }

    public function cancel(): void
    {
        $this->attributes['status'] = 'Canceled';
        $this->save();
    }

    public static function getByUser(int $userId): Collection
    {
        return self::with('payment')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }
}
