<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_escola', function(Blueprint $table)
		{
			$table->string('id_aluno', 9);
			$table->integer('id_escola')->index('id_escola');
			$table->enum('estado', array('Ativo','Transferido','Graduado','Desistente'));
			$table->date('data_ingresso');
			$table->enum('classe_ingresso', array('8','9','10','11','12'));
			$table->primary(['id_aluno','id_escola']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_escola');
	}

}
