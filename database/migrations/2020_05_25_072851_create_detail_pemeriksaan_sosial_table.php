<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailPemeriksaanSosialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_pemeriksaan_sosial', function(Blueprint $table)
		{
			$table->integer('detail_pemeriksaan_sosial_id', true);
			$table->integer('pemeriksaan_sosial_id')->unsigned()->index('pemeriksaan_id');
			$table->boolean('merokok');
			$table->boolean('minum_alkohol');
			$table->boolean('narkoba');
			$table->boolean('free_sex');
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
		Schema::drop('detail_pemeriksaan_sosial');
	}

}
