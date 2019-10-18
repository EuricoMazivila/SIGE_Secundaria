<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalizacaoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localizacao_escola', function(Blueprint $table)
		{
			$table->integer('id_escola')->primary();
			$table->integer('id_bairro')->index('id_bairro');
			$table->smallInteger('Nr');
			$table->string('Avenida_Rua', 60);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('localizacao_escola');
	}

}
