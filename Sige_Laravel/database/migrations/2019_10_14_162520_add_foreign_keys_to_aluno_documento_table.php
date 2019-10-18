<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlunoDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aluno_documento', function(Blueprint $table)
		{
			$table->foreign('id_Aluno', 'aluno_documento_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aluno_documento', function(Blueprint $table)
		{
			$table->dropForeign('aluno_documento_ibfk_1');
		});
	}

}
