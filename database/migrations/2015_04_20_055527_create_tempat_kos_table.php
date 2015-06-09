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
			$table->integer('harga_termurah');
			$table->integer('harga_termahal');
			$table->integer('dilihat')->default(0);
			$table->integer('jumlah_ulasan');
			$table->string('id_ulasan',512);
			$table->string('id_pengulas',512);
			$table->string('provinsi',40);
			$table->string('kota',40);
			$table->string('lokasi',200);
			$table->string('deskripsi_fasilitas',1000);
			$table->string('deskripsi_kondisi',1000);
			$table->string('nama_pemilik',40);
			$table->string('no_tlp',40);
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
