<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno', function(Blueprint $table)
		{
			$table->foreign('codCand', 'aluno_ibfk_4')->references('codCand')->on('candidato_aluno')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('codP', 'aluno_ibfk_5')->references('codP')->on('pessoa')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno', function(Blueprint $table)
		{
			$table->dropForeign('aluno_ibfk_4');
			$table->dropForeign('aluno_ibfk_5');
		});
	}

}
