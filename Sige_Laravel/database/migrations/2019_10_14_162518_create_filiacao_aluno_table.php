<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFiliacaoAlunoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filiacao_aluno', function(Blueprint $table)
		{
			$table->string('id_aluno', 9)->primary();
			$table->integer('id_nat')->default(1)->index('id_nat');
			$table->string('nome_pai', 50);
			$table->integer('telefone_pai');
			$table->string('local_trabalho_pai', 50);
			$table->string('profissao_pai', 50);
			$table->string('nome_mae', 50);
			$table->integer('telefone_mae');
			$table->string('local_trabalho_mae', 50);
			$table->string('profissao_mae', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filiacao_aluno');
	}

}
