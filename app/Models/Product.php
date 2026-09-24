<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'details', 'stock', 'image'];

    /**
     * A product belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('stars');
    }

 
}