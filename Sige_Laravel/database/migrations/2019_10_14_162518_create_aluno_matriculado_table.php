<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoMatriculadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_matriculado', function(Blueprint $table)
		{
			$table->string('id_aluno', 9);
			$table->integer('id_escola');
			$table->date('Data');
			$table->integer('id_Matricula');
			$table->enum('Estado', array('Pendente','Matriculado'))->default('Pendente');
			$table->primary(['id_aluno','id_Matricula']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_matriculado');
	}

}
