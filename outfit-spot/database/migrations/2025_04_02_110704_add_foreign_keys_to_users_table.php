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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['cart_id'], 'users_cart_id_fkey')->references(['id'])->on('orders')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['saved_payment_preference'], 'users_saved_payment_preference_fkey')->references(['id'])->on('payment_details')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['saved_shipping_preference'], 'users_saved_shipping_preference_fkey')->references(['id'])->on('shipping_details')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_cart_id_fkey');
            $table->dropForeign('users_saved_payment_preference_fkey');
            $table->dropForeign('users_saved_shipping_preference_fkey');
        });
    }
};
