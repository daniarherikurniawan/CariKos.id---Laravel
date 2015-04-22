<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempatKosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tempat_kos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_pemilik');
			$table->string('lokasi');
			$table->string('harga');
			$table->string('deskripsi_fasilitas');
			$table->string('deskripsi_kondisi');
			$table->string('nama_pemilik');
			$table->string('no_tlp');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tempat_kos');
	}

}
