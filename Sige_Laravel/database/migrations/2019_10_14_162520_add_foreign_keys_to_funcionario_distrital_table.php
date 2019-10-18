<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioDistritalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario_distrital', function(Blueprint $table)
		{
			$table->foreign('id_cargo', 'funcionario_distrital_ibfk_1')->references('id_Cargo')->on('cargo')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario_distrital', function(Blueprint $table)
		{
			$table->dropForeign('funcionario_distrital_ibfk_1');
		});
	}

}
