<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailPemeriksaanImtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_pemeriksaan_imt', function(Blueprint $table)
		{
			$table->integer('detail_pemeriksaan_imt_id', true);
			$table->integer('pemeriksaan_imt_id')->unsigned()->index('pemeriksaan_imt_id');
			$table->float('berat_badan', 10, 0);
			$table->float('tinggi_badan', 10, 0);
			$table->boolean('vaksin')->default(0);
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
		Schema::drop('detail_pemeriksaan_imt');
	}

}
