<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('escola', function(Blueprint $table)
		{
			$table->foreign('id_Dir', 'escola_ibfk_1')->references('id_Dir')->on('direcao_distrital')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('escola', function(Blueprint $table)
		{
			$table->dropForeign('escola_ibfk_1');
		});
	}

}
