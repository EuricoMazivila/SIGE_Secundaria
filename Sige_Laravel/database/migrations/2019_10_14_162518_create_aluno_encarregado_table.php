<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoEncarregadoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_encarregado', function(Blueprint $table)
		{
			$table->string('id_aluno', 9)->primary();
			$table->string('nome_completo', 50);
			$table->integer('numero_telefone');
			$table->string('local_trabalho', 50);
			$table->string('profissao', 50);
			$table->integer('id_bairro');
			$table->string('Avenida_Rua', 60);
			$table->integer('Q');
			$table->integer('Nr_casa');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_encarregado');
	}

}
