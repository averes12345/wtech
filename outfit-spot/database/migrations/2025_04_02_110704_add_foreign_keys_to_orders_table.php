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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['payment_detaild_id'], 'orders_payment_detaild_id_fkey')->references(['id'])->on('payment_details')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['shipping_details_id'], 'orders_shipping_details_id_fkey')->references(['id'])->on('shipping_details')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'orders_user_id_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_detaild_id_fkey');
            $table->dropForeign('orders_shipping_details_id_fkey');
            $table->dropForeign('orders_user_id_fkey');
        });
    }
};
