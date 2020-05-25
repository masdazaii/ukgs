<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Pemeriksaan;
use App\DetailRujukan;
use Auth;
use Response;
use DB;

class RujukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('rujukan.index');
    }

    public function typeahead(Request $request)
    {
    	// return $request->all();
    	$param = $request->term;
    	$sekolah = Sekolah::where('sekolah_name', 'LIKE','%'.$param.'%')
    				->select('sekolah_name','sekolah_id')
    				->get();
    	return Response::json($sekolah,200);
    }

    public function rujukanAjax($sekolahId)
    {
    	$data = Pemeriksaan::where('rujukan',true)
    			->with(['detailRujukan' => function($query){
    				$query->with('user');
    			},'jenisPemeriksaan', 'siswa'])
                ->whereHas('siswa', function($query) use ($sekolahId){
                    $query->whereHas('kelasMapping', function($query) use ($sekolahId){
                        $query->whereHas('kelas', function($query) use ($sekolahId){
                            $query->where('sekolah_id',$sekolahId);
                        });
                    });
                });
        // return $data;


       	return datatables()->of($data)
            ->addColumn('action',function($data) use ($sekolahId){
                $button = '';
                if (isset($data->detailRujukan->penangan)){
                	$button .= '
                    <button class="btn btn-success btn-sm" >sudah ditangani</button>';
                }else{
                	$button .= '
                    <button data-id="'.$data->pemeriksaan_id.'" class="btn btn-warning btn-sm tangani" >Tangani</button>';
                }
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('jenis_pemeriksaan',function($data){
                return $data->jenisPemeriksaan->name;
            })
            ->editColumn('deskripsi',function($data){
                if(isset($data->detailRujukan->deskripsi)){
                	return $data->detailRujukan->deskripsi;								
                }else{
                	return "Tidak ada deskripsi";
                }
            })
            ->editColumn('penangan',function($data){
                if(isset($data->detailRujukan->penangan)){
                	return $data->detailRujukan->user->name;
                }else{
                	return "Siswa belum ditangani";
                }
            })
            ->make(true);
    }

    public function tangani($id)
    {
    	DB::beginTransaction();
    	try {
    		$pemeriksaanGigi = DetailRujukan::where('pemeriksaan_id',$id)->first();
	    	$pemeriksaanGigi->penangan = Auth::user()->id;
	    	$pemeriksaanGigi->save();

            $pemeriksaan = Pemeriksaan::findOrFail($id);
            $pemeriksaan->rujukan = 0;
            $pemeriksaan->save();
	    	DB::commit();

	    	return Response::json('Siswa rujukan berhasil ditangani',200);
    	} catch (\Exception $e) {
    		DB::rollback();
    		return Response::json('Terdapat kesalahan silahkan hubungi pengembang',500);
    	}
    }
}
