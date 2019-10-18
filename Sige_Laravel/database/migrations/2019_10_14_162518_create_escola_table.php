<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('escola', function(Blueprint $table)
		{
			$table->integer('id_Escola', true);
			$table->string('Nome', 40);
			$table->enum('Nivel', array('Primaria','Secundaria'))->default('Secundaria');
			$table->enum('Pertenca', array('Publica','Privada','Comunitaria'))->default('Publica');
			$table->integer('id_Dir')->index('id_Dir');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('escola');
	}

}
