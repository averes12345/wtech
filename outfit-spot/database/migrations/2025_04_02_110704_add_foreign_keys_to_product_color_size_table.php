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
        Schema::table('product_color_size', function (Blueprint $table) {
            $table->foreign(['colors_id'], 'product_color_size_colors_id_fkey')->references(['id'])->on('colors')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['products_id'], 'product_color_size_products_id_fkey')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['sizes_id'], 'product_color_size_sizes_id_fkey')->references(['id'])->on('sizes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_color_size', function (Blueprint $table) {
            $table->dropForeign('product_color_size_colors_id_fkey');
            $table->dropForeign('product_color_size_products_id_fkey');
            $table->dropForeign('product_color_size_sizes_id_fkey');
        });
    }
};
