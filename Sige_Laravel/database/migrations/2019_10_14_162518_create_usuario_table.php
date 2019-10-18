<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->string('id_User', 9)->primary();
			$table->string('Username', 40)->unique('Username');
			$table->string('Senha', 40);
			$table->string('Email_Instituconal', 100)->unique('Email_Instituconal');
			$table->enum('Estado', array('Ativo','Revogado','Pendente'))->default('Ativo');
			$table->date('DataCriacao');
			$table->enum('Nivel_Acesso', array('Convidado','Candidato','Aluno','Professor','Directoria','Secretaria','Admin','Distrital'))->default('Convidado');
			$table->enum('Local', array('Distrito','Escola','Indefinido'))->default('Indefinido');
			$table->integer('id_Local')->default(0);
			$table->string('Nome_Local', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
