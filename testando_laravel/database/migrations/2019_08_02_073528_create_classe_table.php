<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe', function(Blueprint $table)
		{
			$table->integer('codClass', true);
			$table->enum('classe', array('8','9','10','11','12'));
			$table->enum('turno', array('diurno','nocturno','a distancia'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classe');
	}

}
