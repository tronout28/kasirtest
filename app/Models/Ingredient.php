<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit', 'price','category'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_ingredients')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
