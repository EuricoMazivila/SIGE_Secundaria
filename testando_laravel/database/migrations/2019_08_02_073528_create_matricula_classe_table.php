<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatriculaClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matricula_classe', function(Blueprint $table)
		{
			$table->integer('codMatr');
			$table->integer('codClass')->index('codClass');
			$table->integer('total_Vagas');
			$table->date('ano');
			$table->integer('total_vagas_preenchidas')->default(0);
			$table->primary(['codMatr','codClass']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matricula_classe');
	}

}
