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
			$table->string('id_aluno', 9)->index('id_aluno');
			$table->boolean('id_classe');
			$table->date('ano');
			$table->primary(['id_classe','id_aluno']);
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
