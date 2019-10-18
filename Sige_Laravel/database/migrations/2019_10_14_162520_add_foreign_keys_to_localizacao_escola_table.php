<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocalizacaoEscolaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('localizacao_escola', function(Blueprint $table)
		{
			$table->foreign('id_escola', 'localizacao_escola_ibfk_1')->references('id_Escola')->on('escola')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_bairro', 'localizacao_escola_ibfk_2')->references('id_Bairro')->on('bairro')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('localizacao_escola', function(Blueprint $table)
		{
			$table->dropForeign('localizacao_escola_ibfk_1');
			$table->dropForeign('localizacao_escola_ibfk_2');
		});
	}

}
