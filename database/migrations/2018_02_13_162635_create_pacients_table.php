<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacients', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('phone');
            $table->string('address');
            $table->integer('age');
            $table->integer('gender');
            $table->integer('branch_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->integer('total_amount')->unsigned()->default(0);
            $table->integer('discount')->unsigned()->default(0)->nullable();
            $table->integer('remained_amount')->unsigned()->default(0)->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('doctor_id')
                ->references('id')->on('doctors')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pacients');
    }
}
