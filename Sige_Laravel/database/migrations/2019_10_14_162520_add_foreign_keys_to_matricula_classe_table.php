<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatriculaClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matricula_classe', function(Blueprint $table)
		{
			$table->foreign('id_Matricula', 'matricula_classe_ibfk_1')->references('id_Matricula')->on('matricula')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_Classe', 'matricula_classe_ibfk_2')->references('id_Classe')->on('classe')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matricula_classe', function(Blueprint $table)
		{
			$table->dropForeign('matricula_classe_ibfk_1');
			$table->dropForeign('matricula_classe_ibfk_2');
		});
	}

}
