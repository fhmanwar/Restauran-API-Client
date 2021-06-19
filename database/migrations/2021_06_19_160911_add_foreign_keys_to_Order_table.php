<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Order', function(Blueprint $table)
		{
			$table->foreign('UserId', 'FK_Order_tb_user')->references('id_user')->on('tb_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Order', function(Blueprint $table)
		{
			$table->dropForeign('FK_Order_tb_user');
		});
	}

}
