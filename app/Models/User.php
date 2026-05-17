<?php

// Edited by David García Zapata and Sofia Gallo

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * USERS ATTRIBUTES
 * $this->attributes['id'] - int - contains the user primary key (id)
 * $this->attributes['name'] - string - contains the user name
 * $this->attributes['phone_number'] - string - contains the user phone number
 * $this->attributes['email'] - string - contains the user email
 * $this->attributes['is_admin'] - boolean - indicates if the user is an admin
 * $this->attributes['password'] - string - contains the user password
 * $this->attributes['created_at'] - datetime - contains the user creation date
 * $this->attributes['updated_at'] - datetime - contains the user update date
 *
 * RELATIONSHIPS
 * $this->orders - Order[] - contains the user orders
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'password',
        'is_admin',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->attributes['phone_number'];
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->attributes['phone_number'] = $phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getIsAdmin(): bool
    {
        return $this->attributes['is_admin'];
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->attributes['is_admin'] = $isAdmin;
    }

    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }
}
