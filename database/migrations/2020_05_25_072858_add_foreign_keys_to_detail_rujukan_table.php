<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailRujukanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detail_rujukan', function(Blueprint $table)
		{
			$table->foreign('pemeriksaan_id', 'detail_rujukan_ibfk_1')->references('pemeriksaan_id')->on('pemeriksaan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detail_rujukan', function(Blueprint $table)
		{
			$table->dropForeign('detail_rujukan_ibfk_1');
		});
	}

}
