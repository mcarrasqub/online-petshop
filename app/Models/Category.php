<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * CATEGORIES ATTRIBUTES
 * $this->attributes['id'] - int - contains the category primary key (id)
 * $this->attributes['name'] - string - contains the category name
 * $this->attributes['created_at'] - datetime - contains the category creation date
 * $this->attributes['updated_at'] - datetime - contains the category update date
 *
 * RELATIONSHIPS
 * $this->products - Product[] - contains the category products
 */
class Category extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
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

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }
}
