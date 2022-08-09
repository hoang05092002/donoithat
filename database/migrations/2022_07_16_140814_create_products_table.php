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
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('catalog_id');
            $table->string('name')->unique();
            $table->string('main_img');
            $table->string('brand');
            $table->longText('description');
            $table->integer('size');
            $table->float('price', 10, 2);
            $table->integer('discount');
            $table->integer('status');
            $table->integer('view')->nullable();
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
