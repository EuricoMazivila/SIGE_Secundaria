<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matricula', function(Blueprint $table)
		{
			$table->foreign('id_Escola', 'matricula_ibfk_1')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matricula', function(Blueprint $table)
		{
			$table->dropForeign('matricula_ibfk_1');
		});
	}

}
