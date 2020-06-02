<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Sekolah;
use App\Pemeriksaan;
use App\DetailPemeriksaanSosial;
use App\DetailRujukan;
use Response;
use Auth;
use session;
use DB;
use URL;

class PemeriksaanSosialController extends Controller
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
        return view('pemeriksaan.pemeriksaanSosial.index');
    }

    public function detailPemeriksaanSosialAjax($id,$sekolahId)
    {
         $data = Pemeriksaan::where('jenis_pemeriksaan',$id)
                ->with('detailPemeriksaanSosial','pemeriksa', 'siswa')
                ->whereHas('siswa', function($query) use ($sekolahId){
                    $query->whereHas('kelasMapping', function($query) use ($sekolahId){
                        $query->whereHas('kelas', function($query) use ($sekolahId){
                            $query->where('sekolah_id',$sekolahId);
                        });
                    });
                });

                // return $data;

        return datatables()->of($data)
            ->addColumn('action',function($data) use ($id,$sekolahId){
                $button = '';
                $button .= '<a href="#" type="button" data-id="'.$data->pemeriksaan_id.'" class="btn btn-sm btn-warning edit">Edit</a>
                    <button data-id="'.$data->pemeriksaan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('pemeriksa_id',function($data){
                return $data->pemeriksa->name;
            })
            ->editColumn('merokok',function($data){
                if ($data->detailPemeriksaanSosial->merokok == 1) {
                    return '<span class="badge badge-danger">IYA</span>';
                }else{
                    return '<span class="badge badge-success">Tidak</span>';
                }
            })
            ->editColumn('free_sex',function($data){
                if ($data->detailPemeriksaanSosial->free_sex == 1) {
                    return '<span class="badge badge-danger">IYA</span>';
                }else{
                    return '<span class="badge badge-success">Tidak</span>';
                }
            })
            ->editColumn('narkoba',function($data){
                if ($data->detailPemeriksaanSosial->narkoba == 1) {
                    return '<span class="badge badge-danger">IYA</span>';
                }else{
                    return '<span class="badge badge-success">Tidak</span>';
                }
            })
            ->editColumn('minum_alkohol',function($data){
                if ($data->detailPemeriksaanSosial->minum_alkohol == 1) {
                    return '<span class="badge badge-danger">IYA</span>';
                }else{
                    return '<span class="badge badge-success">Tidak</span>';
                }
            })
            ->rawColumns(['merokok','free_sex','narkoba','minum_alkohol','action'])
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
            'merokok' => 'required',
            'minumAlkohol' =>'required',
            'freeSex' =>'required',
            'narkoba' =>'required',
            'jenisPemeriksaan' => 'required',
            'rujukan' => 'required',
            'siswaId' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaanSosial = new Pemeriksaan;
            $pemeriksaanSosial->pemeriksa_id = Auth::user()->id;
            $pemeriksaanSosial->siswa_id = $request->siswaId;
            $pemeriksaanSosial->jenis_pemeriksaan = $request->jenisPemeriksaan;
            $pemeriksaanSosial->rujukan = $request->rujukan;
            $pemeriksaanSosial->save();

            $pemeriksaanSosialId = $pemeriksaanSosial->pemeriksaan_id;

            if ($request->rujukan == 1) {
                $rujukan = new DetailRujukan;
                $rujukan->pemeriksaan_id = $pemeriksaanSosialId;
                if (isset($request->deskripsi)){
                    $rujukan->deskripsi = $request->deskripsi;
                }
                $rujukan->save(); 
            }

            $detailPemeriksaanSosial = new DetailPemeriksaanSosial;
            $detailPemeriksaanSosial->pemeriksaan_sosial_id = $pemeriksaanSosialId;
            $detailPemeriksaanSosial->merokok = $request->merokok;
            $detailPemeriksaanSosial->free_sex = $request->freeSex;
            $detailPemeriksaanSosial->narkoba = $request->narkoba;
            $detailPemeriksaanSosial->minum_alkohol = $request->minumAlkohol;
            $detailPemeriksaanSosial->save();
            DB::commit();

            return Response::json('Data pemeriksaan sosial berhasil disimpan',200);
        } catch (\Exception $e) {
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
    public function edit($id)
    {
        $sosial = Pemeriksaan::with('detailPemeriksaanSosial','detailRujukan')->findOrFail($id);
        return $sosial;
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
            'merokok' => 'required',
            'minumAlkohol' =>'required',
            'freeSex' =>'required',
            'narkoba' =>'required',
        ]);

        DB::beginTransaction();
        try {
            $detailPemeriksaanSosial = DetailPemeriksaanSosial::where('pemeriksaan_sosial_id',$id)
                                    ->first();
            $detailPemeriksaanSosial->merokok = $request->merokok;
            $detailPemeriksaanSosial->free_sex = $request->freeSex;
            $detailPemeriksaanSosial->narkoba = $request->narkoba;
            $detailPemeriksaanSosial->minum_alkohol = $request->minumAlkohol;
            $detailPemeriksaanSosial->save();

            $pemeriksaanSosial = Pemeriksaan::findOrFail($id);
            if ($pemeriksaanSosial->rujukan == 0 && $request->rujukan == 1) {
                $detailRujukan = new DetailRujukan;
                $detailRujukan->pemeriksaan_id = $id;
                if (isset($request->deskripsi)) {
                    $detailRujukan->deskripsi = $request->deskripsi;
                }
                $detailRujukan->save();

                $pemeriksaanSosial->rujukan = $request->rujukan;
                $pemeriksaanSosial->save();
            }else if($pemeriksaanSosial->rujukan == 1){
                if ($request->rujukan == 1) {
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    if (isset($request->deskripsi)) {
                        $detailRujukan->deskripsi = $request->deskripsi;
                    }
                    $detailRujukan->save();
                }else{
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    $detailRujukan->delete();

                    $pemeriksaanSosial->rujukan = $request->rujukan;
                    $pemeriksaanSosial->save();
                }
            }
            DB::commit();

            return Response::json('Data pemeriksaan sosial berhasil diubah',200);
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
            $pemeriksaanSosial = Pemeriksaan::findOrFail($id);
            $pemeriksaanSosial->delete();
            DB::commit();
            return Response::json('Data pemeriksaan sosial berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
