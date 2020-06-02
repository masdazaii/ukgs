<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/','DashboardController@index');

//Data Sekolah
Route::resource('sekolah', 'SekolahController');
Route::get('/sekolahAjax','SekolahController@sekolahAjax');
Route::prefix('sekolah')->group( function (){
	Route::get('{id}/kelas','SekolahController@kelas');
	Route::resource('kelas', 'KelasController');
	Route::get('{id}/kelasAjax','KelasController@kelasAjax');
	Route::get('{sekolahId}/kelas/{kelasId}/siswa','SiswaController@index');
	Route::post('{sekolahId}/kelas/{kelasId}/naikKelas','SiswaController@naikKelas');
	Route::get('{sekolahId}/kelas/{kelasId}/siswaAjax','SiswaController@siswaAjax');
	Route::resource('siswa','SiswaController');
});

//Data Kelurahan
Route::resource('kelurahan', 'KelurahanController');

//Pemeriksaan Gigi
Route::resource('pemeriksaanGigi', 'PemeriksaanGigiController');
Route::prefix('pemeriksaan')->group(function(){
	Route::get('{id}/pemeriksaanSekolahAjax','PemeriksaanController@pemeriksaanSekolahAjax');
	Route::get('{id}/periksa/{sekolahId}', 'PemeriksaanController@redirectPemeriksaan');
	//PemeriksaanGigi
	Route::get('{id}/periksa/{sekolahId}/detailPemeriksaanGigi/{idPemeriksaanGigi}/edit','PemeriksaanGigiController@edit');
	//Pemeriksaan Buta Warna edit
	Route::get('{id}/periksa/{sekolahId}/detailPemeriksaanBw/{pemeriksaanId}/edit','PemeriksaanBwController@edit');
});
Route::post('storePemeriksaanGigi/{id}','PemeriksaanGigiController@storePemeriksaanGigi')->name('storePemeriksaanGigi');

//Pemeriksaan IMT
Route::resource('pemeriksaanImt', 'PemeriksaanImtController');

//Pemeriksaan Sosial
Route::resource('pemeriksaanSosial','PemeriksaanSosialController');

//Pemeriksaan Penyakit Tidak Menular
Route::resource('pemeriksaanPtm','PemeriksaanPtmController');

//Pemeriksaan Buta Warna
Route::resource('pemeriksaanBw','PemeriksaanBwController');

//Soal Bua Warna
Route::resource('soalButaWarna','SoalButaWarnaController');

//user 
Route::resource('user','UserController');

//Riwayat Pemeriksaan
Route::get('riwayatPemeriksaan', 'RiwayatController@index');
Route::get('riwayatKelas','RiwayatController@riwayatKelas');
Route::get('riwayatSiswa','RiwayatController@riwayatSiswa');
Route::get('riwayatPemeriksaanSiswa','RiwayatController@riwayatPemeriksaanSiswa');

//Rujukan
Route::resource('rujukan','RujukanController');

//Laporan
Route::get('laporan','LaporanController@index');
Route::get('laporan/{id}','DashboardController@laporan')->name('laporan');
Route::get('cekPeriksaSekolah','LaporanController@cekPeriksaSekolah');

Route::get('/pemeriksaan','ExController@pemeriksaan');

//Ajax
Route::get('kelasEditAjax','KelasController@kelasEditAjax');
Route::get('siswaEditAjax','SiswaController@siswaEditAjax');
Route::post('importExcelSekolah','SekolahController@importExcelSekolah');
Route::post('importExcelSiswa','SiswaController@importExcelSiswa');
Route::post('importExcelKelas','KelasController@importExcelKelas');
Route::get('siswaByKelasAjax','PemeriksaanController@siswaByKelasAjax');
Route::get('detailSiswa','PemeriksaanController@detailSiswa');
Route::get('detailPemeriksaanGigiAjax/{id}/{sekolahId}','PemeriksaanGigiController@detailPemeriksaanGigiAjax');
Route::get('detailPemeriksaanImtAjax/{id}/{sekolahId}','PemeriksaanImtController@detailPemeriksaanImtAjax');
Route::get('detailPemeriksaanSosialAjax/{id}/{sekolahId}','PemeriksaanSosialController@detailPemeriksaanSosialAjax');
Route::get('detailPemeriksaanPtmAjax/{id}/{sekolahId}','PemeriksaanPtmController@detailPemeriksaanPtmAjax');
Route::get('detailPemeriksaanBwAjax/{id}/{sekolahId}','PemeriksaanBwController@detailPemeriksaanBwAjax');
Route::get('indekKariesGd/{id}','PemeriksaanGigiController@indekKariesGd');
Route::get('kelurahanAjax','KelurahanController@kelurahanAjax');
Route::get('/userAjax','UserController@userAjax');
Route::get('kelurahanEditAjax','KelurahanController@kelurahanEditAjax');
Route::get('soalButaWarnaAjax','SoalButaWarnaController@soalButaWarnaAjax');
Route::get('/changeStatus','UserController@changeStatus');
Route::get('typeahead','RujukanController@typeahead');
Route::get('typeaheadRiwayat','RiwayatController@typeaheadRiwayat');
Route::get('rujukanAjax/{sekolahId}','RujukanController@rujukanAjax')->name('rujukanAjax');
Route::post('tangani/{id}','RujukanController@tangani')->name('tangani');

//Ajax Chart
Route::get('pemeriksaanChart/{tahunPelajaran}','DashboardController@pemeriksaanChart')->name('pemeriksaanChart');
Route::get('ohisChart/{tahunPelajaran}','DashboardController@ohisChart')->name('ohisChart');
Route::get('fsChart/{tahunPelajaran}','DashboardController@fsChart')->name('fsChart');
Route::get('butaWarnaChart/{tahunPelajaran}','DashboardController@butaWarnaChart')->name('butaWarnaChart');
Route::get('imtChart/{tahunPelajaran}','DashboardController@imtChart')->name('imtChart');
Route::get('sosialChart/{tahunPelajaran}','DashboardController@sosialChart')->name('sosialChart');
Route::get('kesehatanGusiChart/{tahunPelajaran}','DashboardController@kesehatanGusiChart')->name('kesehatanGusiChart');
Route::get('tekananDarahChart/{tahunPelajaran}','DashboardController@tekananDarahChart')->name('tekananDarahChart');

route::get('/contohlaporan','DashboardController@contohlaporan');
