<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bi', function(Blueprint $table)
		{
			$table->integer('codP')->index('codP');
			$table->string('bi', 13)->primary();
			$table->string('local_emissao', 50);
			$table->date('data_emissao');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bi');
	}

}
