<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * PRODUCTS ATTRIBUTES
 * $this->attributes['id'] - int - contains the product primary key (id)
 * $this->attributes['price'] - float - contains the product price
 * $this->attributes['stock'] - int - contains the product stock
 * $this->attributes['name'] - string - contains the product name
 * $this->attributes['image'] - string - contains the product image path
 * $this->attributes['specie'] - string - contains the product specie (dog, cat, bird, fish, rabbit, all)
 * $this->attributes['description'] - string - contains the product description
 * $this->attributes['category_id'] - int - contains the category primary key (id)
 * $this->attributes['created_at'] - datetime - contains the product creation date
 * $this->attributes['updated_at'] - datetime - contains the product update date
 *
 * RELATIONSHIPS
 * $this->category - Category - contains the product category
 * $this->orderItems - OrderItem[] - contains the product order items
 */
class Product extends Model
{
    protected $fillable = [
        'price',
        'stock',
        'name',
        'image',
        'specie',
        'description',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getPrice(): float
    {
        return $this->attributes['price'];
    }

    public function setPrice(float $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getImage(): ?string
    {
        return $this->attributes['image'];
    }

    public function setImage(?string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getImageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'img/')) {
            return asset($this->image);
        }

        return Storage::disk('gcs')->url($this->image);
    }

    public function getSpecie(): string
    {
        return $this->attributes['specie'];
    }

    public function setSpecie(?string $specie): void
    {
        $this->attributes['specie'] = $specie;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getCategoryId(): int
    {
        return $this->attributes['category_id'];
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category()->associate($category);
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public static function search(?string $query, ?int $categoryId): Collection
    {
        return self::query()
            ->when($query, fn ($b) => $b->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%"))
            ->when($categoryId, fn ($b) => $b->where('category_id', $categoryId))
            ->get();
    }
}
