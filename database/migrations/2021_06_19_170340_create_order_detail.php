<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetail extends Migration
{
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
            $table->unsignedBigInteger('OrderId');
            $table->foreign('OrderId')->references('Id')->on('Order')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->unsignedBigInteger('ProductId');
            $table->foreign('ProductId')->references('id_masakan')->on('tb_masakan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('order_detail');
    }
}
