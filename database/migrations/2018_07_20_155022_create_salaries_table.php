<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('notes')->nullable(); 
            $table->integer('reposite_id')->unsigned(); 

            $table->string('basic')->default(0)->nullable(); 
            $table->string('loan')->default(0)->nullable(); 
            $table->string('absence')->default(0)->nullable(); 
            $table->string('late')->default(0)->nullable(); 
            $table->string('extra')->default(0)->nullable();
            $table->string('financial_penalties')->default(0)->nullable(); 
            $table->string('tax')->default(0)->nullable(); 
            $table->string('bonus')->default(0)->nullable();
            $table->string('net')->default(0)->nullable(); 
            $table->timestamps();


            $table
            ->foreign('employee_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');


            $table
            ->foreign('reposite_id')
            ->references('id')
            ->on('reposites')
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
        Schema::dropIfExists('salaries');
    }
}
