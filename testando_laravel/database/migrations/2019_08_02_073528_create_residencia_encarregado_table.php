<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResidenciaEncarregadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('residencia_encarregado', function(Blueprint $table)
		{
			$table->integer('codRes', true);
			$table->integer('codEnc')->index('codEnc');
			$table->integer('codProv');
			$table->integer('codbairro');
			$table->string('av_ou_rua', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('residencia_encarregado');
	}

}
