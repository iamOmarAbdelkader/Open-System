<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();  
            $table->integer('item_id')->unsigned();  
            $table->string('quantity')->default(0);
            $table->timestamps();

            $table
            ->foreign('item_id')
            ->references('id')
            ->on('items')
            ->onDelete('cascade');

            $table
            ->foreign('store_id')
            ->references('id')
            ->on('stores')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantities');
    }
}
