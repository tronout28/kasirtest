<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductsIngredients extends Model
{
    use HasFactory;

    protected $table = 'products_ingredients';

    protected $fillable = ['product_id', 'ingredient_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}