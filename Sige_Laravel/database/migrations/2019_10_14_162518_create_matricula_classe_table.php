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
			$table->integer('id_Matri', true);
			$table->integer('id_Matricula')->index('id_Matricula');
			$table->boolean('id_Classe')->index('Classe');
			$table->enum('Turno', array('Diurno','Noturno'));
			$table->integer('Total_Vagas')->default(0);
			$table->integer('Vagas_Preenchidas')->default(0);
			$table->date('Ano');
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
