<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDirecaoDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('direcao_distrital', function(Blueprint $table)
		{
			$table->foreign('id_Dir', 'direcao_distrital_ibfk_1')->references('id_distrito')->on('distrito')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('direcao_distrital', function(Blueprint $table)
		{
			$table->dropForeign('direcao_distrital_ibfk_1');
		});
	}

}
