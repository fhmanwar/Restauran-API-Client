<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cart', function(Blueprint $table)
		{
			$table->integer('Id', true)->primary();
            $table->unsignedBigInteger('UserId')->nullable();
            $table->foreign('UserId')->references('id_user')->on('tb_user')->onUpdate('RESTRICT')->onDelete('SET NULL');
            $table->unsignedBigInteger('ProductId');
            $table->foreign('ProductId')->references('id_masakan')->on('tb_masakan')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('cart');
    }
}
