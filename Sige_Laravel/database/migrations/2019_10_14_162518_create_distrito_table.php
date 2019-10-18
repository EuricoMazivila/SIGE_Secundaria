<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistritoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('distrito', function(Blueprint $table)
		{
			$table->integer('id_distrito', true);
			$table->integer('id_Prov');
			$table->string('Nome', 40);
			$table->unique(['id_Prov','Nome'], 'id_Prov');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('distrito');
	}

}
