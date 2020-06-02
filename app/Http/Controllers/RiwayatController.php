<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Kelas;
use App\Sekolah;
use App\KelasMapping;
use App\Pemeriksaan;
use Carbon\Carbon;
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
    	// return $tahunAjaran;

    	$result = Pemeriksaan::withTrashed()
    				->where('siswa_id',$id)
    				->select('pemeriksaan_id','pemeriksa_id','siswa_id','created_at','rujukan','jenis_pemeriksaan')
    				->get()
    				->toArray();

    	// $fuck = FunctionHelper::createdatConverter($result[0]->created_at);
    	for($i = 0;$i < count($result); $i++){
    		if(FunctionHelper::createdatConverter($result[$i]['created_at']) != $tahunAjaran)
    		{
    			unset($result[$i]);
    		}
    	}

    	sort($result);

    	$mapping = FunctionHelper::pemeriksaanMapping($result);

    	return $mapping;
    }
}
