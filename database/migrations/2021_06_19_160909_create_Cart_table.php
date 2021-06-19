<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Cart', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('UserId')->nullable()->index('UserId');
			$table->integer('ProductId')->index('ProductId');
			$table->integer('NoMeja')->nullable();
			$table->integer('Qty');
			$table->enum('StatusCart', array('true','false'))->default('false');
			$table->dateTime('CreatedTime');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Cart');
	}

}
