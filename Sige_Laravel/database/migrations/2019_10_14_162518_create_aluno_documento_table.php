<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlunoDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aluno_documento', function(Blueprint $table)
		{
			$table->string('id_Aluno', 9);
			$table->enum('Tipo', array('Cedula','BI'));
			$table->string('Numero', 20);
			$table->date('Data_Emissao');
			$table->string('Local_Emissao', 40);
			$table->enum('Estado', array('Valido','Invalido'))->default('Valido');
			$table->date('Data_Submissao');
			$table->unique(['id_Aluno','Tipo','Estado'], 'id_Pessoa');
			$table->unique(['Tipo','Numero'], 'Tipo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aluno_documento');
	}

}
