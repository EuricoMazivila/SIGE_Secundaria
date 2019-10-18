<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe', function(Blueprint $table)
		{
			$table->boolean('id_Classe')->primary();
			$table->boolean('Classe');
			$table->string('Seccao', 40)->default('Geral');
			$table->unique(['Classe','Seccao'], 'Classe');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classe');
	}

}
