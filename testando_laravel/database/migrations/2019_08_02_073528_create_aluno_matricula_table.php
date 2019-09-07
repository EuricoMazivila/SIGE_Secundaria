<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_matricula', function(Blueprint $table)
		{
			$table->integer('codAl');
			$table->integer('codMatr')->index('codMatr');
			$table->date('data');
			$table->enum('tipo', array('Novo ingresso','Renovacao'))->default('Novo ingresso');
			$table->primary(['codAl','codMatr']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_matricula');
	}

}
