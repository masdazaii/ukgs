<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKelasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kelas', function(Blueprint $table)
		{
			$table->foreign('sekolah_id', 'kelas_ibfk_1')->references('sekolah_id')->on('sekolah')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kelas', function(Blueprint $table)
		{
			$table->dropForeign('kelas_ibfk_1');
		});
	}

}
