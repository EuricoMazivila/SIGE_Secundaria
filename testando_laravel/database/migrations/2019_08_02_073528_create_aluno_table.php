<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno', function(Blueprint $table)
		{
			$table->integer('codAl', true);
			$table->integer('codP')->index('codP');
			$table->enum('turno', array('diurno','nocturno'));
			$table->integer('codCand')->index('codCand');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno');
	}

}
