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
			$table->foreign('codEscola', 'candidato_aluno_ibfk_1')->references('codEscola')->on('escola')->onUpdate('CASCADE')->onDelete('NO ACTION');
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
		});
	}

}
