<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableObra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orgao');
            $table->string('titulo');
            $table->double('latitude',11,8);
            $table->double('longitude',11,8);
            $table->decimal('valor',9,2);
            $table->string('empresa_responsavel');
            $table->string('orgao_responsavel');
            $table->enum('esfera',['municipal','estadual','federal']);
            $table->string('fiscal_obra');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('obras', function (Blueprint $table) {
            Schema::drop('obras');
        });
    }
}
