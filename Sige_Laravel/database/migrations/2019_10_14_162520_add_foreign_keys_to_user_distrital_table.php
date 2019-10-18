<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_distrital', function(Blueprint $table)
		{
			$table->foreign('id_user', 'user_distrital_ibfk_1')->references('id_User')->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_Dir', 'user_distrital_ibfk_2')->references('id_Dir')->on('direcao_distrital')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_distrital', function(Blueprint $table)
		{
			$table->dropForeign('user_distrital_ibfk_1');
			$table->dropForeign('user_distrital_ibfk_2');
		});
	}

}
