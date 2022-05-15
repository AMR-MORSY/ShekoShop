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
        Schema::create('admin__users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name',100);
            $table->unsignedBigInteger('admin_type_id');
            $table->foreignId('admin_type_id')->references('id')->on('admin_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('password',255);
            $table->string('first_name',45);
            $table->string('last_name',45);
            $table->timestamp('last_login');
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
        Schema::dropIfExists('admin__users');
    }
};
