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
        Schema::table('card_details', function (Blueprint $table) {
            $table->foreign(['payment_details_id'], 'card_details_payment_details_id_fkey')->references(['id'])->on('payment_details')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card_details', function (Blueprint $table) {
            $table->dropForeign('card_details_payment_details_id_fkey');
        });
    }
};
