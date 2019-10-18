<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoa', function(Blueprint $table)
		{
			$table->string('id_Pessoa', 9)->primary();
			$table->string('Nome', 40);
			$table->string('Apelido', 40);
			$table->enum('Sexo', array('M','F'))->default('M');
			$table->enum('Estado_Civil', array('Solteiro','Casado'))->default('Solteiro');
			$table->date('Data_Nascimento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pessoa');
	}

}
