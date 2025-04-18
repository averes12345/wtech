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
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign(['orders_id'], 'order_items_orders_id_fkey')->references(['id'])->on('orders')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['specific_product_id'], 'order_items_specific_product_id_fkey')->references(['id'])->on('product_color_size')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_orders_id_fkey');
            $table->dropForeign('order_items_specific_product_id_fkey');
        });
    }
};
