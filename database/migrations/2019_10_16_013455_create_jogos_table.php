<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('classificacao');
            $table->string('nome', 255);
            $table->integer('pontos');
            $table->integer('jogos');
            $table->integer('vitoria');
            $table->integer('derrota');
            $table->integer('empate');
            $table->integer('gols_pro');
            $table->integer('gols_contra');
            $table->integer('saldo_de_gols');
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
        Schema::dropIfExists('jogos');
    }
}
