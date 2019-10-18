<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecuperaSenhaUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recupera_senha_usuario', function(Blueprint $table)
		{
			$table->integer('id_Solicitacao', true);
			$table->string('id_Usuario', 9);
			$table->integer('CodigoRecuperacao');
			$table->date('Data_Validalidade');
			$table->string('Senha_Antiga', 40);
			$table->string('Senha_Nova', 40);
			$table->enum('Tipo_Envio', array('Email','Telefone','Ambos'));
			$table->string('Campo_Envio', 100);
			$table->unique(['id_Usuario','CodigoRecuperacao'], 'id_Usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recupera_senha_usuario');
	}

}
