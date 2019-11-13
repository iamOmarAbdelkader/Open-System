<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable();
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->nullableMorphs('ownerable');
            $table->integer('store_id')->unsigned();  
            $table->integer('order_id')->unsigned()->nullable();  
            $table->string('total')->default(0);
            $table->string('vat')->default(0);
            $table->string('discount')->default(0);
            $table->string('final_total')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();

            $table
            ->foreign('store_id')
            ->references('id')
            ->on('stores')
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
        Schema::dropIfExists('orders');
    }
}
