<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailPemeriksaanPtmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_pemeriksaan_ptm', function(Blueprint $table)
		{
			$table->integer('detail_pemeriksaan_ptm_id', true);
			$table->integer('pemeriksaan_ptm_id')->unsigned()->index('pemeriksaan_ptm_id');
			$table->integer('tekanan_sistolik');
			$table->integer('tekanan_diastolik');
			$table->integer('lingkar_pinggang');
			$table->integer('nilai_gula_darah_sewaktu');
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
		Schema::drop('detail_pemeriksaan_ptm');
	}

}
