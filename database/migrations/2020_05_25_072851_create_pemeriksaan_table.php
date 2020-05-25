<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePemeriksaanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pemeriksaan', function(Blueprint $table)
		{
			$table->increments('pemeriksaan_id');
			$table->integer('pemeriksa_id')->index('sekolah_id');
			$table->integer('siswa_id');
			$table->integer('jenis_pemeriksaan');
			$table->boolean('rujukan')->default(0);
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
		Schema::drop('pemeriksaan');
	}

}
