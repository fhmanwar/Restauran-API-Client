<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('OrderDetail', function(Blueprint $table)
		{
			$table->foreign('OrderId', 'FK_OrderDetail_order')->references('Id')->on('Order')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('ProductId', 'FK_OrderDetail_tb_masakan')->references('id_masakan')->on('tb_masakan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('OrderDetail', function(Blueprint $table)
		{
			$table->dropForeign('FK_OrderDetail_order');
			$table->dropForeign('FK_OrderDetail_tb_masakan');
		});
	}

}
