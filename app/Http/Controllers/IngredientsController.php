<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Validator;

class IngredientsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Ingredient retrieved',
            'data' => Ingredient::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'unit' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ingredient = Ingredient::create($request->only(['name', 'unit', 'price']));

        return response()->json([
            'message' => 'Ingredient created successfully',
            'data' => $ingredient
        ], 201);
    }

    // Get a single ingredient by ID
    public function show($id)
    {
        $ingredient = Ingredient::find($id);

        if ($ingredient) {
            return response()->json([
                'message' => 'Ingredient retrieved',
                'data' => $ingredient
            ]);
        } else {
            return response()->json(['message' => 'Ingredient not found'], 404);
        }
    }

    // Update an ingredient
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'unit' => 'string',
            'price' => 'numeric',
            'category' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $ingredient->update($request->only(['name', 'unit', 'price']));

        return response()->json([
            'message' => 'Ingredient updated successfully',
            'data' => $ingredient
        ]);
    }

    // Delete an ingredient
    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}
