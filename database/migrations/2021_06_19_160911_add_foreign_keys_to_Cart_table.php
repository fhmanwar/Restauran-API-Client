<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Cart', function(Blueprint $table)
		{
			$table->foreign('ProductId', 'FK__tb_masakan')->references('id_masakan')->on('tb_masakan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('UserId', 'FK__tb_user')->references('id_user')->on('tb_user')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Cart', function(Blueprint $table)
		{
			$table->dropForeign('FK__tb_masakan');
			$table->dropForeign('FK__tb_user');
		});
	}

}
