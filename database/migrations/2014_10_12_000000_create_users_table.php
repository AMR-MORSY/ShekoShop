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
            $table->id();
            $table->string('first_name',50)->nullable();
            $table->string("middle_name",50)->nullable();
            $table->string("user_name",50)->unique();
            $table->string("last_name",50)->nullable();
            $table->unsignedInteger("mobile",15)->unique()->nullable();
            $table->string('shipping_address',500)->nullable();
            $table->string('billing_address',500)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime("lastLogin")->nullable()->default(null);
            $table->tinyText("intro")->nullable()->default(null);
            $table->text("Profile")->nullable()->default(null);
            $table->rememberToken();
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
