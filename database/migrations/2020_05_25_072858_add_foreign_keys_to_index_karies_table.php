<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIndexKariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('index_karies', function(Blueprint $table)
		{
			$table->foreign('detail_pemeriksaan_gigi_id', 'index_karies_ibfk_2')->references('detail_pemeriksaan_gigi_id')->on('detail_pemeriksaan_gigi')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('index_karies', function(Blueprint $table)
		{
			$table->dropForeign('index_karies_ibfk_2');
		});
	}

}
