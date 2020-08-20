<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Siswa;
use App\TahunAjaran;

class LaporanController extends Controller
{
	public function index()
	{
        $tahunAjaran = TahunAjaran::all();
		return view('cekLaporan.index',compact('tahunAjaran'));
	}

	public function cekPeriksaSekolah(Request $request)
	{
        $sekolahId = $request->sekolahId;
        $tahunAjaran = $request->tahunAjaran;

		$totalSiswa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId,$tahunAjaran){
                            $query->withTrashed();
							$query->where('tahun_pelajaran',$tahunAjaran);
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
                        ->count();

		$belumDiperiksa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId,$tahunAjaran){
                            $query->withTrashed();
                            $query->where('tahun_pelajaran',$tahunAjaran);
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
						->whereDoesntHave('pemeriksaan',function($query)use ($tahunAjaran){
                            $query->where('tahun_ajaran',$tahunAjaran);
                        })
						->count();

		$sudahDiperiksa = Siswa::whereHas('kelasMapping', function($query) use ($sekolahId,$tahunAjaran){
                            $query->withTrashed();
							$query->where('tahun_pelajaran',$tahunAjaran);
		                    $query->whereHas('kelas', function($query) use ($sekolahId){
		                        $query->where('sekolah_id',$sekolahId);
		                    });
		                })
						->whereHas('pemeriksaan',function($query) use($tahunAjaran){
                            $query->withTrashed();
                            $query->where('tahun_ajaran',$tahunAjaran);
							$query->where('jenis_pemeriksaan',1);
						})
						->whereHas('pemeriksaan',function($query) use($tahunAjaran){
                            $query->withTrashed();
                            $query->where('tahun_ajaran',$tahunAjaran);
							$query->where('jenis_pemeriksaan',2);
						})
						->whereHas('pemeriksaan',function($query) use($tahunAjaran){
                            $query->withTrashed();
                            $query->where('tahun_ajaran',$tahunAjaran);
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
