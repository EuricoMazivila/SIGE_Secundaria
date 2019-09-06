<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResidenciaPessoaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('residencia_pessoa', function(Blueprint $table)
		{
			$table->integer('codRes', true);
			$table->integer('codP')->index('codP');
			$table->integer('codProv');
			$table->integer('codbairro');
			$table->string('av_ou_rua', 50);
			$table->string('quarteirao', 5);
			$table->integer('nr_casa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('residencia_pessoa');
	}

}
