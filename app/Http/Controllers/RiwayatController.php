<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Kelas;
use App\Sekolah;
use App\KelasMapping;
use App\Pemeriksaan;
use Response;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view("riwayatPemeriksaan.index");
    }

    public function typeaheadRiwayat(Request $request)
    {
    	$param = $request->term;
    	$sekolah = Sekolah::where('sekolah_name', 'LIKE','%'.$param.'%')
    				->withTrashed()
    				->select('sekolah_name','sekolah_id')
    				->get();

    	return Response::json($sekolah,200);
    }

    public function riwayatKelas(Request $request)
    {
    	$kelas = Kelas::where('sekolah_id',$request->sekolahId)
    			->withTrashed()
    			->select('kelas_id','kelas_name')
    			->get();

    	return $kelas;
    }

    public function riwayatSiswa(Request $request)
    {
    	$siswa = KelasMapping::where('kelas_id',$request->kelasId)
                ->withTrashed()
                ->with('tahunAjaran')
    			->with(['siswa' => function($query){
    				$query->withTrashed();
                    $query->select('siswa_id','nama');
    			}])
    			->select('tahun_pelajaran','siswa_id')
    			->get();

    	return $siswa;
    }

    public function riwayatPemeriksaanSiswa(Request $request)
    {
    	$exploder = explode('|',$request->data);
    	$id = $exploder[0];
        $tahunAjaran = $exploder[1];

        $result = Pemeriksaan::withTrashed()
                    ->where('tahun_ajaran',$tahunAjaran)
    				->where('siswa_id',$id)
                    ->select('pemeriksaan_id','pemeriksa_id','siswa_id','created_at','rujukan','jenis_pemeriksaan')
                    ->orderBy('created_at','desc')
                    ->get()
                    ->unique('jenis_pemeriksaan')
                    ->toArray();
                    // return $tahunAjaran;

        sort($result);

    	$mapping = FunctionHelper::pemeriksaanMapping($result);

    	return $mapping;
    }
}
