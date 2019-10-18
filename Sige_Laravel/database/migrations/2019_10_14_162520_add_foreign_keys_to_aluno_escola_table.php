<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_escola', function(Blueprint $table)
		{
			$table->foreign('id_aluno', 'aluno_escola_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_escola', 'aluno_escola_ibfk_2')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_escola', function(Blueprint $table)
		{
			$table->dropForeign('aluno_escola_ibfk_1');
			$table->dropForeign('aluno_escola_ibfk_2');
		});
	}

}
