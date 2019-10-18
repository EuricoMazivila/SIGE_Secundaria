<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioPrivilegioAcessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_privilegio_acesso', function(Blueprint $table)
		{
			$table->string('id_usuario', 9);
			$table->integer('id_privilegio')->default(1)->index('id_privilegio');
			$table->enum('Estado', array('Ativo','Desativo'))->default('Ativo');
			$table->primary(['id_usuario','id_privilegio']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario_privilegio_acesso');
	}

}
