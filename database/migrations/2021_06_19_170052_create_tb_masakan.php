<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMasakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_masakan', function(Blueprint $table)
		{
			$table->integer('id_masakan', true);
			$table->string('nama_masakan', 150);
			$table->string('harga', 150);
			$table->integer('stok');
			$table->string('status_masakan', 150);
			$table->string('gambar_masakan', 150)->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_masakan');
    }
}
