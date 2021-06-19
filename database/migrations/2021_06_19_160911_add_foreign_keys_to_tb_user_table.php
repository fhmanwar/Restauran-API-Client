<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTbUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tb_user', function(Blueprint $table)
		{
			$table->foreign('id_level', 'tb_user_ibfk_1')->references('id')->on('tb_level')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tb_user', function(Blueprint $table)
		{
			$table->dropForeign('tb_user_ibfk_1');
		});
	}

}
