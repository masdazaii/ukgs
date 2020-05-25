<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSekolahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sekolah', function(Blueprint $table)
		{
			$table->foreign('kelurahan', 'sekolah_ibfk_1')->references('kelurahan_id')->on('kelurahan')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sekolah', function(Blueprint $table)
		{
			$table->dropForeign('sekolah_ibfk_1');
		});
	}

}
