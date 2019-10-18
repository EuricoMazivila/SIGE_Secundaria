<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvinciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provincia', function(Blueprint $table)
		{
			$table->integer('id_Prov', true);
			$table->integer('id_Pais');
			$table->string('Nome', 40);
			$table->unique(['id_Pais','Nome'], 'id_Pais');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('provincia');
	}

}
