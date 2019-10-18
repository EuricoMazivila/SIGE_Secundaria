<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResidenciaAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('residencia_aluno', function(Blueprint $table)
		{
			$table->foreign('id_aluno', 'residencia_aluno_ibfk_1')->references('id_aluno')->on('aluno')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_bairro', 'residencia_aluno_ibfk_2')->references('id_Bairro')->on('bairro')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('residencia_aluno', function(Blueprint $table)
		{
			$table->dropForeign('residencia_aluno_ibfk_1');
			$table->dropForeign('residencia_aluno_ibfk_2');
		});
	}

}
