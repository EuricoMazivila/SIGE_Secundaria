<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario_escola', function(Blueprint $table)
		{
			$table->integer('id_Escola')->index('id_Escola');
			$table->string('id_Funcionario', 9)->index('id_Pessoa');
			$table->integer('id_Cargo')->index('id_Cargo');
			$table->date('Data_Colocacao');
			$table->enum('Estado', array('Ativo','Desativo'))->default('Ativo');
			$table->enum('Acesso', array('Professor','Secretaria','Directoria','Admin','Convidado'))->default('Convidado');
			$table->unique(['id_Escola','id_Funcionario','id_Cargo'], 'id_Escola_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario_escola');
	}

}
