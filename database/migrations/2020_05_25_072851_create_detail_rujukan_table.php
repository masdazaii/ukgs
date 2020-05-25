<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailRujukanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail_rujukan', function(Blueprint $table)
		{
			$table->integer('detail_rujukan_id', true);
			$table->integer('pemeriksaan_id')->unsigned()->index('pemeriksaan_id');
			$table->integer('penangan')->nullable();
			$table->text('deskripsi', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detail_rujukan');
	}

}
