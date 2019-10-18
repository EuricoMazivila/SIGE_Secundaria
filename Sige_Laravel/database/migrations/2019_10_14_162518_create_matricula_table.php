<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matricula', function(Blueprint $table)
		{
			$table->integer('id_Matricula', true);
			$table->integer('id_Escola')->index('id_Escola');
			$table->enum('Tipo', array('Normal','Renovacao'));
			$table->date('Ano');
			$table->date('Data_Inicio');
			$table->date('Data_Fim');
			$table->enum('Estado', array('Em curso','Pendete','Terminada'))->default('Pendete');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matricula');
	}

}
