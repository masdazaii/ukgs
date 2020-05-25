<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailPemeriksaanGigiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_pemeriksaan_gigi', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_gigi_id', 'detail_pemeriksaan_gigi_ibfk_1')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('pemeriksaan_gigi_id', 'detail_pemeriksaan_gigi_ibfk_2')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_pemeriksaan_gigi', function(Blueprint $table)
		{
			$table->dropForeign('detail_pemeriksaan_gigi_ibfk_1');
			$table->dropForeign('detail_pemeriksaan_gigi_ibfk_2');
		});
	}

}
