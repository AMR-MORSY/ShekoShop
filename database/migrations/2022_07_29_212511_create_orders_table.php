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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method',['cash_on_delivery','visa'])->default('cash_on_delivery');
            $table->enum('shipping_method',['pickup','delivery'])->default('pickup');
            $table->float('subtotal', 8, 2);
            $table->enum('status',['processing','on_hold','shipping','completed'])->default('processing');
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            $table->float('total_price', 8, 2);
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
        Schema::dropIfExists('orders');
    }
};
