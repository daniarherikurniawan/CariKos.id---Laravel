<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama',40);
			$table->string('email')->unique();
			$table->string('password', 10);
			$table->string('peran')->default("penyewa");
			$table->timestamps();
		});
		$user = new User;
		$user->nama = "Fandi Azam";
		$user->email = "fandi@gmail.com";
		$user->password= "1";
		$user->peran = "pemilik";
		$user->save();

		$user2 = new User;
		$user2->nama = "Daniar Heri";
		$user2->email = "daniar.h.k@gmail.com";
		$user2->password= "1";
		$user2->peran = "admin";
		$user2->save();
		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
