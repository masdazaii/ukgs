<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSekolahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sekolah', function(Blueprint $table)
		{
			$table->integer('sekolah_id', true);
			$table->integer('npsn');
			$table->string('sekolah_name', 50);
			$table->string('sekolah_type', 10);
			$table->string('alamat', 50);
			$table->integer('kelurahan')->index('kelurahan');
			$table->string('kecamatan', 20);
			$table->string('kota_administrasi', 50);
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
		Schema::drop('sekolah');
	}

}
