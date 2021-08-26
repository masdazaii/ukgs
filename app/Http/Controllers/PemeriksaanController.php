<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\helpers\FunctionHelper;
use App\Sekolah;
use App\Kelas;
use App\Siswa;
use App\KelasMapping;
use App\SoalButaWarna;
use URL;

class PemeriksaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function pemeriksaanSekolahAjax($id)
    {
        $data = null;
    	if ($id == 1 || $id == 2 || $id == 5) {
    		$data = Sekolah::all();
    	}else{
            $data = Sekolah::whereIn('sekolah_type',['SMA','SMP'])
                    ->get();
        }

        return datatables()->of($data)
        ->addColumn('action',function($data) use ($id){
                $button = '';
                $button .= '<a href="'.URL::to('/pemeriksaan/'.$id.'/periksa/'.$data->sekolah_id).'" data-id="'.$data->sekolah_id.'" class="btn btn-sm btn-success pilih">Pilih</a>';
                return $button;
            })
        ->make(true);
    }

    public function redirectPemeriksaan($id,$sekolahId)
    {
        if($id == 1){
        	return $this->pemeriksaanGigi($id,$sekolahId);
        }else if($id == 2){
        	return $this->pemeriksaanImt($id,$sekolahId);
        }else if($id == 3){
        	return $this->pemeriksaanSosial($id,$sekolahId);
        }else if($id == 4 ){
        	return $this->pemeriksaanPtm($id,$sekolahId);
        }else{
        	return $this->pemeriksaanBw($id,$sekolahId);
        }
    }

    public function pemeriksaanGigi($id,$sekolahId)
    {
    	$kelas = Kelas::where('sekolah_id',$sekolahId)
                ->select('kelas_id','kelas_name')
                ->get();

        $sekolah = Sekolah::select('sekolah_name','sekolah_id')
                    ->findOrFail($sekolahId);

        return view('pemeriksaan.pemeriksaanGigi.create',compact('kelas','id','sekolah'));
    }

    public function pemeriksaanImt($id,$sekolahId)
    {
    	$kelas = Kelas::where('sekolah_id',$sekolahId)
                ->select('kelas_id','kelas_name')
                ->get();

        $sekolah = Sekolah::select('sekolah_name','sekolah_id')
                    ->findOrFail($sekolahId);

        return view('pemeriksaan.pemeriksaanImt.create',compact('kelas','id','sekolah'));
    }

    public function pemeriksaanPtm($id,$sekolahId)
    {
		$kelas = Kelas::where('sekolah_id',$sekolahId)
                ->select('kelas_id','kelas_name')
                ->get();

        $sekolah = Sekolah::select('sekolah_name','sekolah_id')
                    ->findOrFail($sekolahId);

        return view('pemeriksaan.pemeriksaanPtm.create',compact('kelas','id','sekolah'));
    }

    public function pemeriksaanSosial($id,$sekolahId)
    {
    	$kelas = Kelas::where('sekolah_id',$sekolahId)
                ->select('kelas_id','kelas_name')
                ->get();

        $sekolah = Sekolah::select('sekolah_name','sekolah_id')
                    ->findOrFail($sekolahId);

        return view('pemeriksaan.pemeriksaanSosial.create',compact('kelas','id','sekolah'));
    }

    public function pemeriksaanBw($id,$sekolahId)
    {
    	$kelas = Kelas::where('sekolah_id',$sekolahId)
                ->select('kelas_id','kelas_name')
                ->get();

        $sekolah = Sekolah::select('sekolah_name','sekolah_id')
                    ->findOrFail($sekolahId);
                    
    	$soalButaWarna = SoalButaWarna::select('soal_buta_warna_id','deskripsi','image')
    					->get();

        return view('pemeriksaan.pemeriksaanBw.create',compact('kelas','id','soalButaWarna','sekolah'));
    }

    public function siswaByKelasAjax(Request $request)
    {
        $id = $request->id;
        $jenisPemeriksaan = $request->pemeriksaan;
        $data = KelasMapping::where('kelas_id',$id)
                ->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran())
                ->with(['siswa' => function($query){
                    $query->select('siswa_id','nama');
                }])
                ->whereHas('siswa',function($query) use ($jenisPemeriksaan){
                    $query->whereDoesntHave('pemeriksaan',function($query) use ($jenisPemeriksaan){
                        $query->where('jenis_pemeriksaan',$jenisPemeriksaan);
                        $query->whereYear('created_at',date("Y"));
                    });
                })
                ->select('siswa_id')
                ->get();

        return $data;
    }

    public function detailSiswa(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::where('siswa_id',$id)
                ->with(['kelasMapping' => function($query){
                    $query->with(['kelas' => function($query){
                        $query->with('sekolah');
                    }]);
                }])
                ->first();

        return $siswa;
    }
}
