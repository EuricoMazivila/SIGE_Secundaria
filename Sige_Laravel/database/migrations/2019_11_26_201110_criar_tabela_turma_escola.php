<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaTurmaEscola extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Turma_Escola', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Escola_ID')->unsigned();
            $table->string('turma',9);
            $table->integer('Professor_Escola_ID')->unsigned();
            $table->enum('Estado', array('Aberta','Fechada'))->default('Aberta');
            $table->integer('Classe_ID')->unsigned();
            $table->integer('Ano_Lectivo_ID')->unsigned();
            $table->enum('Turno', array('Manha','Tarde','Noturno'))->default('Manha');
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
        Schema::dropIfExists('Turma_Escola');
    }
}
