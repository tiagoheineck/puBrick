<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableFoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obra_id')->unsigned();
            $table->foreign('obra_id')->references('id')->on('obras');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('foto',200);
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
        Schema::table('fotos', function (Blueprint $table) {
            Schema::drop('fotos');
        });
    }
}
