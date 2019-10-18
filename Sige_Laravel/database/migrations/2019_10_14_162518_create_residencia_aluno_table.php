<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResidenciaAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('residencia_aluno', function(Blueprint $table)
		{
			$table->string('id_aluno', 9)->primary();
			$table->integer('id_bairro')->index('id_bairro');
			$table->string('av_ou_rua', 50);
			$table->integer('quarteirao')->default(0);
			$table->integer('nr_casa')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('residencia_aluno');
	}

}
