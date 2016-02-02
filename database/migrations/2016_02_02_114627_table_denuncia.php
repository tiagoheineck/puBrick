<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableDenuncia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('comentario_id')->nullable()->unsigned();
            $table->foreign('comentario_id')->references('id')->on('comentarios');
            $table->integer('foto_id')->nullable()->unsigned();
            $table->foreign('foto_id')->references('id')->on('fotos');
            $table->integer('obra_id')->nullable()->unsigned();
            $table->foreign('obra_id')->references('id')->on('obras');
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
        Schema::table('denuncias', function (Blueprint $table) {
            //
        });
    }
}
