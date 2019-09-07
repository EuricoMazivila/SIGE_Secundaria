<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEncarregadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encarregado', function(Blueprint $table)
		{
			$table->integer('codEnc', true);
			$table->integer('codAl')->index('codAl');
			$table->string('nome_completo', 50);
			$table->integer('numero_telefone');
			$table->string('local_trabalho', 50);
			$table->string('profissao', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('encarregado');
	}

}
