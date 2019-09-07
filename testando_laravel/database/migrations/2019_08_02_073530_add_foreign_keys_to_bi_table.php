<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bi', function(Blueprint $table)
		{
			$table->foreign('codP', 'bi_ibfk_1')->references('codP')->on('pessoa')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bi', function(Blueprint $table)
		{
			$table->dropForeign('bi_ibfk_1');
		});
	}

}
