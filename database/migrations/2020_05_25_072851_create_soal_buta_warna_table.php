<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoalButaWarnaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soal_buta_warna', function(Blueprint $table)
		{
			$table->integer('soal_buta_warna_id', true);
			$table->string('deskripsi', 100);
			$table->string('image', 50);
			$table->integer('jawaban_benar');
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
		Schema::drop('soal_buta_warna');
	}

}
