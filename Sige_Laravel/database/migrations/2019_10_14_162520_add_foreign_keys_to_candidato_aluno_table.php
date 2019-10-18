<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCandidatoAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('candidato_aluno', function(Blueprint $table)
		{
			$table->foreign('id_candidato', 'candidato_aluno_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_escola', 'candidato_aluno_ibfk_2')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('candidato_aluno', function(Blueprint $table)
		{
			$table->dropForeign('candidato_aluno_ibfk_1');
			$table->dropForeign('candidato_aluno_ibfk_2');
		});
	}

}
