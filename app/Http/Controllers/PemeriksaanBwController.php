<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use session;
use URL;
use Response;
use App\Pemeriksaan;
use App\DetailPemeriksaanBw;
use App\DetailRujukan;
use App\SoalButaWarna;

class PemeriksaanBwController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pemeriksaan.pemeriksaanBw.index');
    }

    public function detailPemeriksaanBwAjax($id,$sekolahId)
    {
        $data = Pemeriksaan::where('jenis_pemeriksaan',$id)
                ->with(['detailPemeriksaanBw' => function($query){ 
                    $query->with(['soalButaWarna' => function($q){ $q->select('soal_buta_warna_id','jawaban_benar');} ]);
                },'pemeriksa', 'siswa'])
                ->whereHas('siswa', function($query) use ($sekolahId){
                    $query->whereHas('kelasMapping', function($query) use ($sekolahId){
                        $query->whereHas('kelas', function($query) use ($sekolahId){
                            $query->where('sekolah_id',$sekolahId);
                        });
                    });
                })
                ->orderBy('created_at','DESC');

        return datatables()->of($data)
            ->addColumn('action',function($data) use ($id,$sekolahId){
                $button = '';
                $button .= '<a href="'.URL::to('pemeriksaan/'.$id.'/periksa/'.$sekolahId.'/detailPemeriksaanBw/'.$data->pemeriksaan_id.'/edit').'" type="button"  class="btn btn-sm btn-warning edit">Edit</a>
                            <button data-id="'.$data->pemeriksaan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('pemeriksa_id',function($data){
                return $data->pemeriksa->name;
            })
            ->editColumn('status_buta_warna',function($data){
                if ($data->rujukan == 1) {
                    return '<span class="badge badge-warning">Perlu dirujuk</span>';
                }else{
                    return '<span class="badge badge-success">Normal</span>';
                }
            })
            ->rawColumns(['status_buta_warna','action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'siswaId' => 'required',
            'jenisPemeriksaan' => 'required',
            'hasilPemeriksaan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaanBw = new Pemeriksaan;
            $pemeriksaanBw->siswa_id = $request->siswaId;   
            $pemeriksaanBw->jenis_pemeriksaan = $request->jenisPemeriksaan;
            $pemeriksaanBw->pemeriksa_id = Auth::user()->id;
            $pemeriksaanBw->save();

            $pemeriksaanBwId = $pemeriksaanBw->pemeriksaan_id;
            $temp = null;
            for ($i=0; $i < count($request->hasilPemeriksaan); $i++) { 
                $detailPemeriksaanBw = new DetailPemeriksaanBw;
                $detailPemeriksaanBw->pemeriksaan_bw_id = $pemeriksaanBwId;
                $detailPemeriksaanBw->soal_bw_id = $request->hasilPemeriksaan[$i]['soalId'];
                $detailPemeriksaanBw->jawaban = $request->hasilPemeriksaan[$i]['jawaban'];
                $detailPemeriksaanBw->save();

                $detailJawaban = SoalButaWarna::findOrFail($request->hasilPemeriksaan[$i]['soalId']);
                if($detailJawaban->jawaban_benar != $request->hasilPemeriksaan[$i]['jawaban']){
                    $temp++;
                }
            }

            if ($temp >= 3) {
                $pemeriksaanBw->rujukan = 1;
                $pemeriksaanBw->save();

                $detailRujukan = new DetailRujukan;
                $detailRujukan->pemeriksaan_id = $pemeriksaanBwId;
                $detailRujukan->deskripsi = "terdapat lebih dari 3 soal yang salah sehingga siswa disarankan untuk dirujuk ke rumah sakit terdekat";
                $detailRujukan->save();
            }

            DB::commit();

            return Response::json('Data pemeriksaan buta warna berhasil disimpan',200);
        }catch(\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sekolahId,$id,$pemeriksaanId)
    {
        $pemeriksaanBw = Pemeriksaan::with(['detailPemeriksaanBw' => function($query){
                            $query->with('soalButaWarna');
                        }])
                        ->findOrFail($pemeriksaanId);

        return view('pemeriksaan.pemeriksaanBw.edit',compact('pemeriksaanBw','id','sekolahId')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'hasilPemeriksaan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $temp = 0;
            for ($i=0; $i < count($request->hasilPemeriksaan); $i++) { 
                $pemeriksaanBw = DetailPemeriksaanBw::where('pemeriksaan_bw_id',$id)
                                ->where('soal_bw_id',$request->hasilPemeriksaan[$i]['soalId'])
                                ->first();
                $pemeriksaanBw->jawaban = $request->hasilPemeriksaan[$i]['jawaban'];
                $pemeriksaanBw->save();

                $detailJawaban = SoalButaWarna::findOrFail($request->hasilPemeriksaan[$i]['soalId']);
                if($detailJawaban->jawaban_benar != $request->hasilPemeriksaan[$i]['jawaban']){
                    $temp++;
                }
            }

            $pemeriksaan = Pemeriksaan::findOrFail($id);
            if ($temp == 3) {
                $pemeriksaan->rujukan = 1;
            }else{
                $pemeriksaan->rujukan = 0;
            }
            $pemeriksaan->save();

            DB::commit();
            return Response::json('Data pemeriksaan buta warna berrhasil diubah',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pemeriksaanBw = Pemeriksaan::findOrFail($id);
            $pemeriksaanBw->delete();

            DB::commit();
            return Response::json('Data pemeriksaan buta warna berrhasil diubah',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
