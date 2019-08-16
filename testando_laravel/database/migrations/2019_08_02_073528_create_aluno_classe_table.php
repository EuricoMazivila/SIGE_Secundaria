<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_classe', function(Blueprint $table)
		{
			$table->integer('codAl');
			$table->integer('codClass')->index('codClass');
			$table->date('ano');
			$table->primary(['codAl','codClass']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_classe');
	}

}
