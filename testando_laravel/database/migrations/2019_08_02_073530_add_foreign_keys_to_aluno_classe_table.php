<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_classe', function(Blueprint $table)
		{
			$table->foreign('codClass', 'aluno_classe_ibfk_1')->references('codClass')->on('classe')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('codAl', 'aluno_classe_ibfk_2')->references('codAl')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_classe', function(Blueprint $table)
		{
			$table->dropForeign('aluno_classe_ibfk_1');
			$table->dropForeign('aluno_classe_ibfk_2');
		});
	}

}
