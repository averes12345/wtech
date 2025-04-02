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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->foreign(['categories_id'], 'product_categories_categories_id_fkey')->references(['id'])->on('categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['products_id'], 'product_categories_products_id_fkey')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign('product_categories_categories_id_fkey');
            $table->dropForeign('product_categories_products_id_fkey');
        });
    }
};
