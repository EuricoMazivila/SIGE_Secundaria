<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidatoMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidato_matricula', function(Blueprint $table)
		{
			$table->integer('codCand');
			$table->integer('codMatr')->index('codMatr');
			$table->date('data');
			$table->primary(['codCand','codMatr']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('candidato_matricula');
	}

}
