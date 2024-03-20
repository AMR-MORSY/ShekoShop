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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name',50)->unique();
            $table->unsignedBigInteger('devision_id');
            $table->foreign('devision_id')->references('id')->on('devisions')->onDelete('cascade')->onUpdate('cascade');
            $table->string("slug",50)->unique();
            $table->string('description',300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
