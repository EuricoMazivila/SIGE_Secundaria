<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecuperaSenhaUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recupera_senha_usuario', function(Blueprint $table)
		{
			$table->foreign('id_Usuario', 'recupera_senha_usuario_ibfk_1')->references('id_User')->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recupera_senha_usuario', function(Blueprint $table)
		{
			$table->dropForeign('recupera_senha_usuario_ibfk_1');
		});
	}

}
