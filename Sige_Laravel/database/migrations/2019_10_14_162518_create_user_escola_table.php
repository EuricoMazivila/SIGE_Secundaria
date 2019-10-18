<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_escola', function(Blueprint $table)
		{
			$table->string('id_User', 9)->index('id_User');
			$table->integer('id_Escola')->index('id_Escola');
			$table->enum('Tipo', array('Aluno','Candidato','Professor','Secretaria','Directoria','Admin','Convidado'))->default('Convidado');
			$table->enum('Estado', array('Ativo','Desativo'))->default('Ativo');
			$table->primary(['id_User','id_Escola']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_escola');
	}

}
