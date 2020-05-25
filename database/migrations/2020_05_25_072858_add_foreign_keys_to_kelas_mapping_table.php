<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKelasMappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kelas_mapping', function(Blueprint $table)
		{
			$table->foreign('kelas_id', 'kelas_mapping_ibfk_1')->references('kelas_id')->on('kelas')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('siswa_id', 'kelas_mapping_ibfk_2')->references('siswa_id')->on('siswa')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kelas_mapping', function(Blueprint $table)
		{
			$table->dropForeign('kelas_mapping_ibfk_1');
			$table->dropForeign('kelas_mapping_ibfk_2');
		});
	}

}
