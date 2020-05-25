<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKelasMappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kelas_mapping', function(Blueprint $table)
		{
			$table->integer('kelas_mapping_id', true);
			$table->integer('kelas_id')->index('kelas_id');
			$table->integer('siswa_id')->index('siswa_id');
			$table->string('tahun_pelajaran', 10);
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
		Schema::drop('kelas_mapping');
	}

}
