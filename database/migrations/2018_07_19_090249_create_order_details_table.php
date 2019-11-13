<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();  
            $table->integer('order_id')->unsigned();  
            $table->string('unite_price')->nullable();
            $table->string('quantity')->default(0);
            $table->string('discount')->default(0);
            $table->timestamps();


            $table
            ->foreign('item_id')
            ->references('id')
            ->on('items')
            ->onDelete('cascade');

            $table
            ->foreign('order_id')
            ->references('id')
            ->on('orders')
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
        Schema::dropIfExists('order_details');
    }
}
