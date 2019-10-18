<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoInternoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_interno', function(Blueprint $table)
		{
			$table->string('id_Aluno', 9)->index('id_Aluno');
			$table->integer('id_Escola')->index('id_Escola');
			$table->integer('id_Classe');
			$table->integer('id_Turma');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_interno');
	}

}
