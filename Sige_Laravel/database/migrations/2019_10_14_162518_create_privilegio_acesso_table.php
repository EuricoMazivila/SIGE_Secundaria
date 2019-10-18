<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrivilegioAcessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privilegio_acesso', function(Blueprint $table)
		{
			$table->integer('id_Privilegio', true);
			$table->enum('Acesso', array('Convidado','Aluno','Candidato','Professor','Secretaria','Directoria','Admin'))->default('Convidado');
			$table->string('Descricao', 40);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('privilegio_acesso');
	}

}
