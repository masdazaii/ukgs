<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailPemeriksaanSosialTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_pemeriksaan_sosial', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_sosial_id', 'detail_pemeriksaan_sosial_ibfk_1')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_pemeriksaan_sosial', function(Blueprint $table)
		{
			$table->dropForeign('detail_pemeriksaan_sosial_ibfk_1');
		});
	}

}
