<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContactoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contacto', function(Blueprint $table)
		{
			$table->foreign('id_Pessoa', 'contacto_ibfk_1')->references('id_Pessoa')->on('pessoa')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contacto', function(Blueprint $table)
		{
			$table->dropForeign('contacto_ibfk_1');
		});
	}

}
