<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Order', function(Blueprint $table)
		{
			$table->integer('Id', true);
            $table->unsignedBigInteger('UserId')->nullable();
            $table->foreign('UserId')->references('id_user')->on('tb_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->integer('NoMeja')->nullable();
			$table->integer('Total');
			$table->integer('Bayar')->nullable();
			$table->integer('Kembali')->nullable();
			$table->enum('StatusOrder', array('true','false'))->default('false');
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
        Schema::dropIfExists('order');
    }
}
