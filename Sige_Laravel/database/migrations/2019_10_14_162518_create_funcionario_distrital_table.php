<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuncionarioDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionario_distrital', function(Blueprint $table)
		{
			$table->string('id_Funcionario', 9);
			$table->integer('id_distrito');
			$table->integer('id_cargo')->index('id_cargo');
			$table->enum('Estado', array('Ativo','Desativado'))->default('Ativo');
			$table->date('Data_Cadastro');
			$table->primary(['id_Funcionario','id_distrito']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionario_distrital');
	}

}
