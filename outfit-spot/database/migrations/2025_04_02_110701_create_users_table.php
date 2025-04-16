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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('email')->unique('users_email_key');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('phone')->nullable();
            $table->text('password');
            $table->integer('saved_shipping_preference')->nullable();
            $table->integer('saved_payment_preference')->nullable();
            $table->integer('cart_id')->nullable();
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
