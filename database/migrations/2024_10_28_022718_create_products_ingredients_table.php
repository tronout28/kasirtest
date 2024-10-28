<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // kolom product_id
            $table->unsignedBigInteger('ingredient_id'); // kolom ingredient_id
            $table->integer('quantity');
            $table->timestamps();

            // Foreign key untuk product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // Foreign key untuk ingredient_id
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_ingredients', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['ingredient_id']);
        });
        Schema::dropIfExists('products_ingredients');
    }
};
