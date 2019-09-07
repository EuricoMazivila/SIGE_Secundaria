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
			$table->integer('codP', true);
			$table->string('apelido', 30);
			$table->string('nomes', 50);
			$table->integer('coddist')->index('coddist');
			$table->date('data_nascimento');
			$table->enum('sexo', array('M','F'));
			$table->enum('estado_civil', array('Casado(a)','Solteiro(a)'));
			$table->integer('numero_telefone');
			$table->string('email', 30);
			$table->binary('foto', 65535)->nullable();
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
