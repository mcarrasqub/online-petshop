<?php

// Edited by David García Zapata and Sofia Gallo

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * USERS ATTRIBUTES
 * $this->attributes['id'] - int - contains the user primary key (id)
 * $this->attributes['name'] - string - contains the user name
 * $this->attributes['email'] - string - contains the user email
 * $this->attributes['phone_number'] - string - contains the user phone number
 * $this->attributes['password'] - string - contains the user password
 * $this->attributes['is_admin'] - boolean - indicates if the user is an admin
 * $this->attributes['created_at'] - datetime - contains the user creation date
 * $this->attributes['updated_at'] - datetime - contains the user update date
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
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber): void
    {
        $this->phone_number = $phoneNumber;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setIsAdmin($isAdmin): void
    {
        $this->is_admin = $isAdmin;
    }
}
