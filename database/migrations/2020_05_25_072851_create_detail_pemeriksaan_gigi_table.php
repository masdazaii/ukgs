<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailPemeriksaanGigiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_pemeriksaan_gigi', function(Blueprint $table)
		{
			$table->integer('detail_pemeriksaan_gigi_id', true);
			$table->integer('pemeriksaan_gigi_id')->unsigned()->index('pemeriksaan_gigi_id');
			$table->boolean('exo_pers')->comment('0 = + ,1 = -');
			$table->boolean('fs')->comment('0 = + , 1 = -');
			$table->integer('debris_1');
			$table->integer('debris_2');
			$table->integer('debris_3');
			$table->integer('debris_4');
			$table->integer('debris_5');
			$table->integer('debris_6');
			$table->integer('kalkulus_1');
			$table->integer('kalkulus_2');
			$table->integer('kalkulus_3');
			$table->integer('kalkulus_4');
			$table->integer('kalkulus_5');
			$table->integer('kalkulus_6');
			$table->float('ohis', 10, 0);
			$table->integer('kesehatan_gusi')->comment('0 = baik,1 = cukup, 3 = kurang,4 = jelek');
			$table->integer('frekuensi_menyikat_gigi');
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
		Schema::drop('detail_pemeriksaan_gigi');
	}

}
