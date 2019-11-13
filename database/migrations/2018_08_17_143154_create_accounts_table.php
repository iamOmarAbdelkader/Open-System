<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('no')->nullable(); 
            $table->integer('reposite_id')->unsigned(); 
            $table->integer('order_id')->unsigned()->nullable();  
            $table->nullableMorphs('accountable'); 
            $table->string('type')->nullable(); 
            $table->string('cost')->default(0);                     
            $table->date('date')->nullable();                                    
            $table->timestamps();

            $table
            ->foreign('reposite_id')
            ->references('id')
            ->on('reposites')
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
        Schema::dropIfExists('accounts');
    }
}
