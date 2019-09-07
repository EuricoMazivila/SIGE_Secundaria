<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDadosEscolaAnteriorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dados_escola_anterior', function(Blueprint $table)
		{
			$table->integer('codDados', true);
			$table->integer('codAl')->index('codAl');
			$table->enum('classe_anterior', array('7','8','9','10','11','12'));
			$table->string('turma', 5);
			$table->integer('numero');
			$table->date('ano');
			$table->integer('codEscola')->index('codEscola');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dados_escola_anterior');
	}

}
