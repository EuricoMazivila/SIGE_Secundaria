<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDistritoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('distrito', function(Blueprint $table)
		{
			$table->foreign('id_Prov', 'distrito_ibfk_1')->references('id_Prov')->on('provincia')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('distrito', function(Blueprint $table)
		{
			$table->dropForeign('distrito_ibfk_1');
		});
	}

}
