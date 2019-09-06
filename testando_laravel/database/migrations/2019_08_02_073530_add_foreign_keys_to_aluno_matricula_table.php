<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_matricula', function(Blueprint $table)
		{
			$table->foreign('codMatr', 'aluno_matricula_ibfk_2')->references('codMatr')->on('matricula')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('codAl', 'aluno_matricula_ibfk_3')->references('codAl')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_matricula', function(Blueprint $table)
		{
			$table->dropForeign('aluno_matricula_ibfk_2');
			$table->dropForeign('aluno_matricula_ibfk_3');
		});
	}

}
