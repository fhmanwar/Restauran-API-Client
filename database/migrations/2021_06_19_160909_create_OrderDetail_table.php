<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('OrderDetail', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('OrderId')->index('OrderId');
			$table->integer('ProductId')->index('ProductId');
			$table->integer('Qty');
			$table->integer('SubTotal');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('OrderDetail');
	}

}
