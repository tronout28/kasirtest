<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'category'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'products_ingredients')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}