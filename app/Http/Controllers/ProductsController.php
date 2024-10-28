<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
  // Get all products with ingredients
  public function index()
  {
      return response()->json([
          'message' => 'Product retrieved',
          'data' => Product::with('ingredients')->get()
      ]);
  }

  // Create new product with ingredients
  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'name' => 'required|string',
          'price' => 'required|numeric',
          'stock' => 'required|integer',
          'category' => 'required|string',
          'ingredients' => 'required|array',
          'ingredients.*.id' => 'exists:ingredients,id',
          'ingredients.*.quantity' => 'required|integer|min:1'
      ]);

      $product = Product::create($validatedData);

      // Attach ingredients with quantities
      foreach ($validatedData['ingredients'] as $ingredient) {
          $product->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
      }

      return response()->json([
          'message' => 'Product created successfully',
          'data' => $product->load('ingredients')
      ], 201);
  }

  // Get single product by ID with ingredients
  public function show($id)
  {
      $product = Product::with('ingredients')->find($id);

      if ($product) {
          return response()->json([
              'message' => 'Product retrieved',
              'data' => $product
          ]);
      } else {
          return response()->json(['message' => 'Product not found'], 404);
      }
  }

  // Update product with ingredients
  public function update(Request $request, $id)
  {
      $product = Product::findOrFail($id);

      $validatedData = $request->validate([
          'name' => 'string',
          'price' => 'numeric',
          'stock' => 'integer',
          'category' => 'string',
          'ingredients' => 'array',
          'ingredients.*.id' => 'exists:ingredients,id',
          'ingredients.*.quantity' => 'integer|min:1'
      ]);

      $product->update($validatedData);

      if ($request->has('ingredients')) {
          $syncData = [];
          foreach ($validatedData['ingredients'] as $ingredient) {
              $syncData[$ingredient['id']] = ['quantity' => $ingredient['quantity']];
          }
          $product->ingredients()->sync($syncData);
      }

      return response()->json([
          'message' => 'Product updated successfully',
          'data' => $product->load('ingredients')
      ]);
  }

  // Delete a product
  public function destroy($id)
  {
      $product = Product::findOrFail($id);
      $product->delete();

      return response()->json(['message' => 'Product deleted successfully']);
  }
}
