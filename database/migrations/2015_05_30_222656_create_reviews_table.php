<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('judul_ulasan',50);
			$table->string('isi_ulasan',1000);
			$table->string('nama_user',40);
			$table->integer('id_user');
			$table->integer('id_kosan');
			$table->boolean('telah_diedit')->default(false);
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
		Schema::drop('reviews');
	}

}
