<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function(Blueprint $table)
		{
			$table->integer('id_user', true)->primary();
			$table->string('username', 150)->nullable()->unique('username');
			$table->string('password', 150)->nullable();
			$table->string('passHash', 150)->nullable();
			$table->string('nama_user', 150);
			$table->unsignedBigInteger('id_level');
            $table->foreign('id_level')->references('id')->on('tb_level')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->string('status', 150)->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_user');
    }
}
