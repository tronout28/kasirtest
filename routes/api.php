<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\IngredientsController;

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductsController::class, 'index']);             // GET All Products
    Route::post('/store', [ProductsController::class, 'store']);       // POST Create Product
    Route::get('/detail/{id}', [ProductsController::class, 'show']);   // GET Product by ID
    Route::put('/update/{id}', [ProductsController::class, 'update']); // PUT Update Product
});

Route::group(['prefix' => 'ingredient'], function () {
    Route::get('/', [IngredientsController::class, 'index']);           // GET All Ingredients
    Route::post('/store', [IngredientsController::class, 'store']);     // POST Create Ingredient
    Route::get('/detail/{id}', [IngredientsController::class, 'show']); // GET Ingredient by ID
    Route::put('/update/{id}', [IngredientsController::class, 'update']); // PUT Update Ingredient
});

