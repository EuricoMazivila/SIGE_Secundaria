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
			$table->string('id_candidato', 9);
			$table->integer('id_escola')->index('id_escola');
			$table->enum('classe_matricular', array('8','9','10','11','12'));
			$table->enum('regime', array('Diurno','Nocturno'));
			$table->date('ano');
			$table->enum('Estado', array('Candidato','Cadastrado','Matriculado'))->default('Candidato');
			$table->primary(['id_candidato','id_escola']);
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
