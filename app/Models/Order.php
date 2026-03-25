<?php

// Edited by David García Zapata

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * ORDERS ATTRIBUTES
 * $this->attributes['id'] - int - contains the order primary key (id)
 * $this->attributes['total'] - float - contains the order total amount
 * $this->attributes['status'] - string - contains the order status
 * $this->attributes['address'] - string - contains the order shipping address
 * $this->attributes['user_id'] - int - contains the user primary key (id)
 * $this->attributes['created_at'] - datetime - contains the order creation date
 * $this->attributes['updated_at'] - datetime - contains the order update date
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

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getOrderItems(): HasMany
    {
        return $this->orderItems();
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    // Setters
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setUser(User $user): void
    {
        $this->user()->associate($user);
    }

    public function confirm(): void
    {
        $this->status = 'Confirmed';
        $this->save();
    }

    public function cancel(): void
    {
        $this->status = 'Canceled';
        $this->save();
    }

    public static function createFromCart(int $userId, string $address, array $cart): self
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return self::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'pending',
            'address' => $address,
        ]);
    }

    public static function getByUser(int $userId): Collection
    {
        return self::with('payment')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }
}
