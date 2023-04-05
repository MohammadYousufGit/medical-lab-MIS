<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacienttestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacienttests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacient_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->timestamps();
            $table->foreign('pacient_id')
                ->references('id')->on('pacients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('test_id')
                ->references('id')->on('tests')
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
        Schema::dropIfExists('pacienttests');
    }
}
