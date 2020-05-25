<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemeriksaan;
use App\DetailPemeriksaanImt;
use App\Sekolah;
use App\DetailRujukan;   
use Auth;             
use URL;
use DB;
use session;
use Response;


class PemeriksaanImtController extends Controller
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
        return view('pemeriksaan.pemeriksaanImt.index');
    }

    public function detailPemeriksaanImtAjax($id,$sekolahId)
    {
        $data = Pemeriksaan::where('jenis_pemeriksaan',$id)
                ->with('detailPemeriksaanImt','pemeriksa', 'siswa')
                ->whereHas('siswa', function($query) use ($sekolahId){
                    $query->whereHas('kelasMapping', function($query) use ($sekolahId){
                        $query->whereHas('kelas', function($query) use ($sekolahId){
                            $query->where('sekolah_id',$sekolahId);
                        });
                    });
                })
                ->get();

        // return $data;

        return datatables()->of($data)
            ->addColumn('action',function($data) use ($id,$sekolahId){
                $button = '';
                $button .= '
                    <button data-idPemeriksaanImt="'.$data->pemeriksaan_id.'" class="btn btn-success btn-sm detail" >Detail</button>
                    <a href="#" type="button" data-id="'.$data->pemeriksaan_id.'" class="btn btn-sm btn-warning edit">Edit</a>
                    <button data-id="'.$data->pemeriksaan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('pemeriksa_id',function($data){
                return $data->pemeriksa->name;
            })
            ->editColumn('berat_badan',function($data){
                return $data->detailPemeriksaanImt->berat_badan;
            })
            ->editColumn('tinggi_badan',function($data){
                return $data->detailPemeriksaanImt->tinggi_badan;
            })
            ->editColumn('kategori',function($data){
                $tb = $data->detailPemeriksaanImt->tinggi_badan/100;
                $imt = number_format($data->detailPemeriksaanImt->berat_badan/($tb*$tb),1);
                if ($imt < 17) {
                    return '<span class="badge badge-danger">Sangat kurus</span>';
                }else if($imt >= 17 && $imt <= 18.4 ){
                    return '<span class="badge badge-warning">Kurus</span>';
                }else if($imt >= 18.5 && $imt <= 25 ){
                    return '<span class="badge badge-success">Normal</span>';
                }else if($imt >= 25.1 && $imt <= 27 ){
                    return '<span class="badge badge-warning">Gemuk</span>';
                }else{
                    return '<span class="badge badge-danger">Sangat gemuk</span>';
                }
            })
            ->rawColumns(['kategori','action'])
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
        // return $request->all();
        $this->validate($request,[
            'bb' => 'required',
            'tb' =>'required',
            'rujukan' => 'required',
            'vaksin' => 'required',
            'jenisPemeriksaan' => 'required',
            'siswaId' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaanImt = new Pemeriksaan;
            $pemeriksaanImt->pemeriksa_id = Auth::user()->id;
            $pemeriksaanImt->siswa_id = $request->siswaId;
            $pemeriksaanImt->jenis_pemeriksaan = $request->jenisPemeriksaan;
            $pemeriksaanImt->rujukan = $request->rujukan;
            $pemeriksaanImt->save();

            $pemeriksaanImtId = $pemeriksaanImt->pemeriksaan_id;
            $detailPemeriksaanImt = new DetailPemeriksaanImt;
            $detailPemeriksaanImt->pemeriksaan_imt_id = $pemeriksaanImtId;
            $detailPemeriksaanImt->tinggi_badan = $request->tb;
            $detailPemeriksaanImt->berat_badan = $request->bb;
            $detailPemeriksaanImt->vaksin = $request->vaksin;
            $detailPemeriksaanImt->save();

             if ($request->rujukan == 1) {
                $rujukan = new DetailRujukan;
                $rujukan->pemeriksaan_id = $pemeriksaanImtId;
                if (isset($request->deskripsi)) {
                    $rujukan->deskripsi = $request->deskripsi;
                }
                $rujukan->save(); 
            }
            DB::commit();

            return Response::json('Data pemeriksaan IMT berhasil ditambahkan',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemeriksaanImt = Pemeriksaan::with(['detailPemeriksaanImt' => function($query){
                                $query->select('pemeriksaan_imt_id','berat_badan','tinggi_badan','vaksin');
                            },'siswa' => function($query){
                                $query->select('siswa_id','nama','nis','usia','jenis_kelamin');
                            }])
                            ->select('pemeriksaan_id','pemeriksa_id','siswa_id','rujukan','created_at')
                            ->findOrFail($id);

        return $pemeriksaanImt;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imt = Pemeriksaan::with('detailPemeriksaanImt','detailRujukan')->findOrFail($id);
        return $imt;
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
        // return $request->all();
        $this->validate($request,[
            'bb' => 'required',
            'tb' =>'required',
            'vaksin' => 'required',
            'rujukan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $detailPemeriksaanImt = DetailPemeriksaanImt::where('pemeriksaan_imt_id',$id)
                                ->first();
            $detailPemeriksaanImt->tinggi_badan = $request->tb;
            $detailPemeriksaanImt->berat_badan = $request->bb;
            $detailPemeriksaanImt->vaksin = $request->vaksin;
            $detailPemeriksaanImt->save();

            $pemeriksaanImt = Pemeriksaan::findOrFail($id);

            if ($pemeriksaanImt->rujukan == 0 && $request->rujukan == 1) {
                $detailRujukan = new DetailRujukan;
                $detailRujukan->pemeriksaan_id = $id;
                if (isset($request->deskripsi)) {
                    $detailRujukan->deskripsi = $request->deskripsi;
                }
                $detailRujukan->save();

                $pemeriksaanImt->rujukan = $request->rujukan;
                $pemeriksaanImt->save();
            }else{
                if ($request->rujukan == 1) {
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    if (isset($request->deskripsi)) {
                        $detailRujukan->deskripsi = $request->deskripsi;
                    }else{
                        $detailRujukan->deskripsi = '-';
                    }
                    $detailRujukan->save();
                }else{
                    $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    $detailRujukan->delete();

                    $pemeriksaanImt->rujukan = $request->rujukan;
                    $pemeriksaanImt->save();
                }
            }
            DB::commit();

            return Response::json('Data pemeriksaan IMT berhasil diubah',200);
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
            $pemeriksaanImt = Pemeriksaan::findOrFail($id);
            $pemeriksaanImt->delete();

            if ($pemeriksaanImt->rujukan == 1) {
                $detailRujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                $detailRujukan->delete();
            }
            
            DB::commit();
            return Response::json('Data pemeriksaan IMT berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
