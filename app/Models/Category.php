<?php
// Edited by Mariana Carrasquilla Botero

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CATEGORIES ATTRIBUTES
 * $this->attributes['id'] - int - contains the category primary key (id)
 * $this->attributes['name'] - string - contains the category name
 * $this->attributes['created_at'] - datetime - contains the category creation date
 * $this->attributes['updated_at'] - datetime - contains the category update date
 */
class Category extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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
}
