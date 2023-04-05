<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacienttestresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacienttestresults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacienttest_id')->unsigned();
            $table->integer('parameter_id')->unsigned();
            $table->string('result');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('pacienttest_id')
                ->references('id')->on('pacient_test')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parameter_id')
                ->references('id')->on('testparameters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacienttestresults');
    }
}
