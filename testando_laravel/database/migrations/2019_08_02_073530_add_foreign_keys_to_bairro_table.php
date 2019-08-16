<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBairroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bairro', function(Blueprint $table)
		{
			$table->foreign('coddist', 'bairro_ibfk_1')->references('coddist')->on('distrito')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bairro', function(Blueprint $table)
		{
			$table->dropForeign('bairro_ibfk_1');
		});
	}

}
