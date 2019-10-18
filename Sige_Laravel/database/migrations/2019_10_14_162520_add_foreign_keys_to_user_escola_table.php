<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_escola', function(Blueprint $table)
		{
			$table->foreign('id_User', 'user_escola_ibfk_1')->references('id_User')->on('usuario')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_Escola', 'user_escola_ibfk_2')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_escola', function(Blueprint $table)
		{
			$table->dropForeign('user_escola_ibfk_1');
			$table->dropForeign('user_escola_ibfk_2');
		});
	}

}
