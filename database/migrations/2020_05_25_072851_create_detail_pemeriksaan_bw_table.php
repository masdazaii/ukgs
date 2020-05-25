<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailPemeriksaanBwTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_pemeriksaan_bw', function(Blueprint $table)
		{
			$table->integer('detail_pemeriksaan_bw_id', true);
			$table->integer('pemeriksaan_bw_id')->unsigned()->index('pemeriksaan_bw_id');
			$table->integer('soal_bw_id');
			$table->integer('jawaban');
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
		Schema::drop('detail_pemeriksaan_bw');
	}

}
