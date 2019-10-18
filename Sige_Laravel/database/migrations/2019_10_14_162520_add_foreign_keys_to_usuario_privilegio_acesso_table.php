<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuarioPrivilegioAcessoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuario_privilegio_acesso', function(Blueprint $table)
		{
			$table->foreign('id_privilegio', 'usuario_privilegio_acesso_ibfk_1')->references('id_Privilegio')->on('privilegio_acesso')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_usuario', 'usuario_privilegio_acesso_ibfk_2')->references('id_User')->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuario_privilegio_acesso', function(Blueprint $table)
		{
			$table->dropForeign('usuario_privilegio_acesso_ibfk_1');
			$table->dropForeign('usuario_privilegio_acesso_ibfk_2');
		});
	}

}
