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
			$table->integer('codEscola', true);
			$table->string('nome_escola', 50);
			$table->enum('nivel', array('primaria','secundaria','misto'));
			$table->enum('tipo', array('publica','privada'));
			$table->integer('coddist')->index('coddist');
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
