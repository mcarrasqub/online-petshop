<?php
// Edited by Mariana Carrasquilla Botero

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * PRODUCTS ATTRIBUTES
 * $this->attributes['id'] - int - contains the product primary key (id)
 * $this->attributes['name'] - string - contains the product name
 * $this->attributes['price'] - float - contains the product price
 * $this->attributes['stock'] - int - contains the product stock
 * $this->attributes['image'] - string - contains the product image path
 * $this->attributes['specie'] - string - contains the product specie (dog, cat, bird, fish, rabbit)
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSpecie()
    {
        return $this->specie;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setSpecie($specie)
    {
        $this->specie = $specie;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCategory($category)
    {
        $this->category()->associate($category);
    }

}
