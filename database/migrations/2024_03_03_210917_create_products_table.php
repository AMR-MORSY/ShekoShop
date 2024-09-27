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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',100)->unique();
            $table->string('notes',100)->nullable();
            $table->string('acidity',100)->nullable();
            $table->string('processing',100)->nullable();
            $table->string('body',100)->nullable();
            $table->string('region',100)->nullable();
            $table->string('subregion',100)->nullable();
            $table->string('farm_owner',100)->nullable();
            $table->string('altitude',100)->nullable();
            $table->string('varietal',100)->nullable();
            $table->string('slug',100)->unique();
            $table->unsignedDouble('product_price',8, 2);
            $table->string('product_shortDesc',300);
            $table->text('product_longDesc');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedDouble('product_stock',8, 2)->default(0);
            $table->boolean('product_live')->default(0);
            $table->integer("rating")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
