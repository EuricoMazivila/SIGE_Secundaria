<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFuncionarioEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funcionario_escola', function(Blueprint $table)
		{
			$table->foreign('id_Escola', 'funcionario_escola_ibfk_1')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_Funcionario', 'funcionario_escola_ibfk_2')->references('id_Funcionaio')->on('funcionario')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_Cargo', 'funcionario_escola_ibfk_3')->references('id_Cargo')->on('cargo')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funcionario_escola', function(Blueprint $table)
		{
			$table->dropForeign('funcionario_escola_ibfk_1');
			$table->dropForeign('funcionario_escola_ibfk_2');
			$table->dropForeign('funcionario_escola_ibfk_3');
		});
	}

}
