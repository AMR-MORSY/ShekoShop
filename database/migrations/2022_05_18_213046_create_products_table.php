<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_SKU",50)->nullable();
            $table->string('product_name',100);
            $table->float('product_price',8, 2);
            $table->float('product_weight')->nullable();
            $table->string('product_cartDesc',250);
            $table->string('product_shortDesc',1000);
            $table->text('product_longDesc');
            $table->string('product_thumb',100)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->float('product_stock',8, 2);
            $table->boolean('product_live')->default(0);
            $table->string('product_location',250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
