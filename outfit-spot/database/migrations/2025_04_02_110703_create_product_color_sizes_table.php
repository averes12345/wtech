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
        Schema::create('product_color_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('colors_id')->constrained('colors')->onDelete('cascade');
            $table->foreignId('sizes_id')->constrained('sizes')->onDelete('cascade');
            $table->integer('count_in_stock')->nullable()->default(0);
            $table->enum('status', ['in_stock', 'in_transit', 'sold_out'])->default('in_stock');

            $table->unique(['products_id', 'colors_id', 'sizes_id'], 'product_color_size_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_color_sizes', function (Blueprint $table) {
            $table->dropUnique('product_color_size_unique');
            $table->dropForeign(['products_id']);
            $table->dropForeign(['colors_id']);
            $table->dropForeign(['sizes_id']);
        });

        Schema::dropIfExists('product_color_sizes');;
    }
};
