<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailPemeriksaanBwTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_pemeriksaan_bw', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_bw_id', 'detail_pemeriksaan_bw_ibfk_1')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('pemeriksaan_bw_id', 'detail_pemeriksaan_bw_ibfk_2')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_pemeriksaan_bw', function(Blueprint $table)
		{
			$table->dropForeign('detail_pemeriksaan_bw_ibfk_1');
			$table->dropForeign('detail_pemeriksaan_bw_ibfk_2');
		});
	}

}
