<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_distrital', function(Blueprint $table)
		{
			$table->string('id_user', 9);
			$table->integer('id_Dir')->index('id_Dir');
			$table->enum('Tipo', array('Admin','Distrital','Convidado'))->default('Convidado');
			$table->enum('Estado', array('Ativo','Desativo'))->default('Ativo');
			$table->primary(['id_user','id_Dir']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_distrital');
	}

}
