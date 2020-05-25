<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKelurahanMappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kelurahan_mapping', function(Blueprint $table)
		{
			$table->integer('kelurahan_mapping_id', true);
			$table->integer('kelurahan_id');
			$table->integer('sekolah_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kelurahan_mapping');
	}

}
