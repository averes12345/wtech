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
        Schema::table('shipping_details', function (Blueprint $table) {
            $table->foreign(['country_id'], 'shipping_details_country_id_fkey')->references(['code'])->on('countries')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_details', function (Blueprint $table) {
            $table->dropForeign('shipping_details_country_id_fkey');
        });
    }
};
