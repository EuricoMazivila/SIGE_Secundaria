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
			$table->integer('codMatr', true);
			$table->date('dataI');
			$table->date('dataF');
			$table->enum('estado', array('Em espera','Activa','Terminada'))->default('Em espera');
			$table->integer('total_vagas');
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
