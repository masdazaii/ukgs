<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailPemeriksaanPtmTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_pemeriksaan_ptm', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_ptm_id', 'detail_pemeriksaan_ptm_ibfk_1')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_pemeriksaan_ptm', function(Blueprint $table)
		{
			$table->dropForeign('detail_pemeriksaan_ptm_ibfk_1');
		});
	}

}
