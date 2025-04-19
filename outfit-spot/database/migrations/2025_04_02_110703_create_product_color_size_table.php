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
        Schema::create('product_color_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->foreignId('product_image_id')->constrained('product_images')->onDelete('cascade');
            $table->integer('count_in_stock')->nullable()->default(0);
            $table->enum('status', ['in_stock', 'in_transit', 'sold_out'])->default('in_stock');
            $table->timestamps();
            $table->unique(['product_id', 'color_id', 'size_id'], 'product_color_size_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_color_size');
    }
};
