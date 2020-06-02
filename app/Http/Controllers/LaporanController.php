<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Siswa;

class LaporanController extends Controller
{
	public function index()
	{
		return view('cekLaporan.index');
	}

	public function cekPeriksaSekolah(Request $request)
	{
		$sekolahId = $request->sekolahId;

		$totalSiswa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId){
							$query->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran());
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
						->count();

		$belumDiperiksa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId){
							$query->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran());
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
						->whereDoesntHave('pemeriksaan')
						->count();

		$sudahDiperiksa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId){
							$query->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran());
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
						->whereHas('pemeriksaan',function($query){
							$query->where('jenis_pemeriksaan',1);
						})
						->whereHas('pemeriksaan',function($query){
							$query->where('jenis_pemeriksaan',2);
						})
						->whereHas('pemeriksaan',function($query){
							$query->where('jenis_pemeriksaan',5);
						})
						->count();

		$sedangDiperiksa = $totalSiswa - ($belumDiperiksa+$sudahDiperiksa);

		$result = [
			"totalSiswa" => $totalSiswa,
			"belumDiperiksa" => $belumDiperiksa,
			"sedangDiperiksa" => $sedangDiperiksa,
			"sudahDiperiksa" => $sudahDiperiksa
		];

		return $result;
	}
}
