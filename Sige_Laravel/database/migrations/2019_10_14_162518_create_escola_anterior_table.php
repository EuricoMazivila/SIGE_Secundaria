<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEscolaAnteriorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escola_anterior', function(Blueprint $table)
		{
			$table->string('id_Candidato', 9)->primary();
			$table->string('Nome_escola', 60);
			$table->string('Turma', 9)->default('N/D');
			$table->enum('Classe', array('7','8','9','10','11','12'))->default('7');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('escola_anterior');
	}

}
