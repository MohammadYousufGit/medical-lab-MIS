<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
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
        Schema::dropIfExists('materials');
    }
}
