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
	Route::get('{sekolahId}/kelas/{kelasId}/siswaAjax','SiswaController@siswaAjax');
	Route::resource('siswa','SiswaController');
});

//Data Kelurahan
Route::resource('kelurahan', 'KelurahanController');

//Pemeriksaan Gigi
Route::resource('pemeriksaanGigi', 'PemeriksaanGigiController');
Route::get('/pemeriksaanGigiSekolahAjax','PemeriksaanGigiController@pemeriksaanGigiSekolahAjax');
Route::prefix('pemeriksaanGigi')->group(function(){
	Route::get('{id}/periksa', 'PemeriksaanGigiController@createPemeriksaanGigi')->name("periksaGigi");
	Route::get('{id}/periksa/{idDetail}/edit','PemeriksaanGigiController@edit');
});
Route::post('storePemeriksaanGigi/{id}','PemeriksaanGigiController@storePemeriksaanGigi')->name('storePemeriksaanGigi');

Route::get('/pemeriksaan','ExController@pemeriksaan');

//Ajax
Route::get('kelasEditAjax','KelasController@kelasEditAjax');
Route::get('siswaEditAjax','SiswaController@siswaEditAjax');
Route::post('importExcelSekolah','SekolahController@importExcelSekolah');
Route::post('importExcelSiswa','SiswaController@importExcelSiswa');
Route::post('siswaByKelasAjax','PemeriksaanGigiController@siswaByKelasAjax');
Route::post('detailSiswa','PemeriksaanGigiController@detailSiswa');
Route::get('detailPemeriksaanGigiAjax/{id}','PemeriksaanGigiController@detailPemeriksaanGigiAjax');
Route::get('indekKariesGd/{id}','PemeriksaanGigiController@indekKariesGd');
Route::get('kelurahanAjax','KelurahanController@kelurahanAjax');
Route::get('kelurahanEditAjax','KelurahanController@kelurahanEditAjax');

