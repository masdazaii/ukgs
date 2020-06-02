<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemeriksaan;
use App\DetailPemeriksaanPtm;
use App\DetailRujukan;
use URL;
use DB;
use Auth;
use Response;

class PemeriksaanPtmController extends Controller
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
        return view('pemeriksaan.pemeriksaanPtm.index');
    }

    public function detailPemeriksaanPtmAjax($id,$sekolahId)
    {

         $data = Pemeriksaan::where('jenis_pemeriksaan',$id)
                ->with('detailPemeriksaanPtm','pemeriksa', 'siswa')
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
            ->editColumn('tekanan_darah',function($data){
                return $data->detailPemeriksaanPtm->tekanan_sistolik.'/'.$data->detailPemeriksaanPtm->tekanan_diastolik;
            })
            ->editColumn('lingkar_pinggang',function($data){
                return $data->detailPemeriksaanPtm->lingkar_pinggang;
            })
            ->editColumn('nilai_gula_darah_sewaktu',function($data){
                return $data->detailPemeriksaanPtm->nilai_gula_darah_sewaktu;
            })
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
            'sistolik' => 'required',
            'diastolik' =>'required',
            'lingkarPinggang' =>'required',
            'gulaDarah' =>'required',
            'jenisPemeriksaan' => 'required',
            'siswaId' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaanPtm = new Pemeriksaan;
            $pemeriksaanPtm->pemeriksa_id = Auth::user()->id;
            $pemeriksaanPtm->jenis_pemeriksaan = $request->jenisPemeriksaan;
            $pemeriksaanPtm->siswa_id = $request->siswaId;
            $pemeriksaanPtm->rujukan = $request->rujukan;
            $pemeriksaanPtm->save();

            $pemeriksaanPtmId = $pemeriksaanPtm->pemeriksaan_id;

            if ($request->rujukan == 1) {
                $rujukan = new DetailRujukan;
                $rujukan->pemeriksaan_id = $pemeriksaanPtmId;
                if (isset($request->deskripsi)) {
                    $rujukan->deskripsi = $request->deskripsi;
                }
                $rujukan->save(); 
            }

            $detailPemeriksaanPtm = new DetailPemeriksaanPtm;
            $detailPemeriksaanPtm->pemeriksaan_ptm_id = $pemeriksaanPtmId;
            $detailPemeriksaanPtm->tekanan_sistolik = $request->sistolik;
            $detailPemeriksaanPtm->tekanan_diastolik = $request->diastolik;
            $detailPemeriksaanPtm->lingkar_pinggang = $request->lingkarPinggang;
            $detailPemeriksaanPtm->nilai_gula_darah_sewaktu = $request->gulaDarah;
            $detailPemeriksaanPtm->save();
            DB::commit();

            return Response::json('Data pemeriksaan penyakit tidak menular berhasil disimpan',200);
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
    public function edit($id)
    {
        $ptm = Pemeriksaan::with('detailPemeriksaanPtm','detailRujukan')->findOrFail($id);
        return $ptm;
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
            'sistolik' => 'required',
            'diastolik' =>'required',
            'lingkarPinggang' =>'required',
            'gulaDarah' =>'required'
        ]);

        DB::beginTransaction();
        try {
            $detailPemeriksaanPtm = DetailPemeriksaanPtm::where('pemeriksaan_ptm_id',$id)
                        ->first();
            $detailPemeriksaanPtm->tekanan_sistolik = $request->sistolik;
            $detailPemeriksaanPtm->tekanan_diastolik = $request->diastolik;
            $detailPemeriksaanPtm->lingkar_pinggang = $request->lingkarPinggang;
            $detailPemeriksaanPtm->nilai_gula_darah_sewaktu = $request->gulaDarah;
            $detailPemeriksaanPtm->save();

            $pemeriksaanPtm = Pemeriksaan::findOrFail($id);
            if ($pemeriksaanPtm->rujukan == 0 && $request->rujukan == 1) {
                $detailRujukan = new DetailRujukan;
                $detailRujukan->pemeriksaan_id = $id;
                if (isset($request->deskripsi)) {
                    $detailRujukan->deskripsi = $request->deskripsi;
                }
                $detailRujukan->save();

                $pemeriksaanPtm->rujukan = $request->rujukan;
                $pemeriksaanPtm->save();
            }else if($pemeriksaanPtm->rujukan == 1){
                if ($request->rujukan == 1) {
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    if (isset($request->deskripsi)) {
                        $detailRujukan->deskripsi = $request->deskripsi;
                    }
                    $detailRujukan->save();
                }else{
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    $detailRujukan->delete();

                    $pemeriksaanPtm->rujukan = $request->rujukan;
                    $pemeriksaanPtm->save();
                }
            }
            DB::commit();

            return Response::json('Data pemeriksaan penyakit tidak menular berhasil diubah',200);
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
            $pemeriksaanPtm = Pemeriksaan::findOrFail($id);
            $pemeriksaanPtm->delete();
            DB::commit();

            return Response::json('Data pemeriksaan penyakit tidak menular berhasi dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
