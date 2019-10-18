<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFiliacaoAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filiacao_aluno', function(Blueprint $table)
		{
			$table->foreign('id_aluno', 'filiacao_aluno_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_nat', 'filiacao_aluno_ibfk_2')->references('id_distrito')->on('distrito')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filiacao_aluno', function(Blueprint $table)
		{
			$table->dropForeign('filiacao_aluno_ibfk_1');
			$table->dropForeign('filiacao_aluno_ibfk_2');
		});
	}

}
