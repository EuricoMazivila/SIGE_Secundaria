<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProfessorEscola extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Professor_Escola', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Escola_ID')->unsigned();
            $table->string('Professor_ID',9);
            $table->enum('Estado', array('Ativo','Inativo'))->default('Ativo');
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
        Schema::dropIfExists('Professor_Escola');
    }
}
