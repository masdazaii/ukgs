<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndexKariesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('index_karies', function(Blueprint $table)
		{
			$table->integer('index_karies_id', true);
			$table->integer('detail_pemeriksaan_gigi_id')->index('detail_pemeriksaan_gigi_id');
			$table->string('posisi_gigi', 11);
			$table->integer('keadaan_gigi');
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
		Schema::drop('index_karies');
	}

}
