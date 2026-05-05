<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * PRODUCTS ATTRIBUTES
 * $this->attributes['id'] - int - contains the product primary key (id)
 * $this->attributes['name'] - string - contains the product name
 * $this->attributes['price'] - float - contains the product price
 * $this->attributes['stock'] - int - contains the product stock
 * $this->attributes['image'] - string - contains the product image path
 * $this->attributes['specie'] - string - contains the product specie (dog, cat, bird, fish, rabbit, all)
 * $this->attributes['description'] - string - contains the product description
 * $this->attributes['category_id'] - int - contains the category primary key (id)
 * $this->attributes['created_at'] - datetime - contains the product creation date
 * $this->attributes['updated_at'] - datetime - contains the product update date
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
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
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getImageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'img/')) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }

    public function getSpecie(): string
    {
        return $this->specie;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function setSpecie(?string $specie): void
    {
        $this->specie = $specie;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setCategory(Category $category): void
    {
        $this->category()->associate($category);
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
