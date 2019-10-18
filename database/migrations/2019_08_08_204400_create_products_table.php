<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('model');
            $table->string('brand');
            $table->string('color');
            $table->string('dimensions');
            $table->string('display_size');
            $table->string('img');
            $table->char('feature',255);
            $table->dateTime('released');
            $table->integer('quantity');
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
        //
    }
}
