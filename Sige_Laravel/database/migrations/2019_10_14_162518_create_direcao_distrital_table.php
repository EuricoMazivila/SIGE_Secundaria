<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirecaoDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('direcao_distrital', function(Blueprint $table)
		{
			$table->integer('id_Dir')->primary();
			$table->string('Designacao', 40);
			$table->integer('Total_Escola')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('direcao_distrital');
	}

}
