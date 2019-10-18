<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEscolaAnteriorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('escola_anterior', function(Blueprint $table)
		{
			$table->foreign('id_Candidato', 'escola_anterior_ibfk_1')->references('id_candidato')->on('candidato_aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('escola_anterior', function(Blueprint $table)
		{
			$table->dropForeign('escola_anterior_ibfk_1');
		});
	}

}
