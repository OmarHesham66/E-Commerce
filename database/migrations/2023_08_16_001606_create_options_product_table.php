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
        Schema::create('options_product', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL', 40, 41, 42, 43, 44, 45]);
            $table->integer('quantity');
            $table->foreignId('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options_product');
    }
};
