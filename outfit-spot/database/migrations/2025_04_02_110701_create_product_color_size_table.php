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
            $table->increments('id');
            $table->integer('products_id')->nullable();
            $table->integer('colors_id')->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('count_in_stock')->nullable()->default(0);

            $table->unique(['products_id', 'colors_id', 'sizes_id'], 'product_color_size_products_id_colors_id_sizes_id_key');
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
