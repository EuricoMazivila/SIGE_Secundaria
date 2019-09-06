<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->integer('codUsuario', true);
			$table->string('usuario', 50);
			$table->string('senha', 32);
			$table->string('email', 50);
			$table->enum('tipo', array('aluno','funcionario','',''));
			$table->integer('codP')->index('codP');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
