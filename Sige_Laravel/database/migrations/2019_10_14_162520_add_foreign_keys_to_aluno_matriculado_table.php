<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoMatriculadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_matriculado', function(Blueprint $table)
		{
			$table->foreign('id_aluno', 'aluno_matriculado_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_matriculado', function(Blueprint $table)
		{
			$table->dropForeign('aluno_matriculado_ibfk_1');
		});
	}

}
