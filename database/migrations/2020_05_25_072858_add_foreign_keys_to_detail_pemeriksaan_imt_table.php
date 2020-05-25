<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailPemeriksaanImtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_pemeriksaan_imt', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_imt_id', 'detail_pemeriksaan_imt_ibfk_2')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_pemeriksaan_imt', function(Blueprint $table)
		{
			$table->dropForeign('detail_pemeriksaan_imt_ibfk_2');
		});
	}

}
