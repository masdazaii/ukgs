<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiswaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siswa', function(Blueprint $table)
		{
			$table->integer('siswa_id', true);
			$table->string('nama', 50);
			$table->string('nis', 11);
			$table->string('nisn', 20);
			$table->string('jenis_kelamin', 10);
			$table->string('tempat_lahir', 50);
			$table->date('tanggal_lahir');
			$table->integer('usia');
			$table->string('agama', 20);
			$table->string('nama_orang_tua', 30);
			$table->text('alamat', 65535);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('siswa');
	}

}
