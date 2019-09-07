<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidatoAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidato_aluno', function(Blueprint $table)
		{
			$table->integer('codCand')->primary();
			$table->string('nome_completo', 50)->unique('nome_completo');
			$table->enum('classe_anterior', array('7','8','9','10','11','12'));
			$table->enum('classe_matricular', array('8','9','10','11','12'));
			$table->enum('turno', array('diurno','nocturno','a distancia'));
			$table->integer('codEscola')->index('codEscola');
			$table->string('senha', 32);
			$table->enum('estado', array('Matriculado','Pre Matriculado','Nao Matriculado'))->default('Nao Matriculado');
			$table->date('ano');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('candidato_aluno');
	}

}
