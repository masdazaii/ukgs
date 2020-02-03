<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PemeriksaanGigi;
use App\Sekolah;
use App\Kelas;
use App\Siswa;
use App\DetailPemeriksaanGigi;
use App\indekKaries;
use DB;
use URL;
use session;

class PemeriksaanGigiController extends Controller
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
        return view('pemeriksaan.pemeriksaanGigi.index');
    }

    public function pemeriksaanGigiSekolahAjax()
    {
        $data = Sekolah::with('pemeriksaanGigi')->get();

        return datatables()->of($data)
        ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="'.URL::to('/pemeriksaanGigi/'.$data->sekolah_id.'/periksa').'" data-id="'.$data->sekolah_id.'" class="btn btn-sm btn-success pilih">Pilih</a>
                            <button type="submit" data-id="'.$data->sekolah_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
        ->addColumn('status',function($data){
            if (isset($data->pemeriksaanGigi->status)) {
                if($data->pemeriksaanGigi->status == 0){
                    return '<span class="badge badge-warning">Sedang Diperiksa</span>';
                }else{
                    return '<span class="badge badge-success">Success</span>';
                }
            }
            else{
                return '<span class="badge badge-danger">Belum diperiksa</span>';
            }
        })
        ->rawColumns(['status','action'])
        ->make(true);
    }

    public function detailPemeriksaanGigiAjax($id)
    {
        $data = DetailPemeriksaanGigi::with(['siswa' => function($query){
                    $query->select('siswa_id','nama');
                },'kelas' => function($query){
                    $query->select('kelas_id','kelas_name');
                }])
                ->select('sekolah_id','detail_pemeriksaan_gigi_id','siswa_id','kelas_id','jumlah_gigi_permanen','jumlah_gigi_sulung','ohis','rujukan')
                ->where('sekolah_id',$id)
                ->get();
        // return $data;

        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="'.URL::to('/pemeriksaanGigi/'.$data->sekolah_id.'/periksa/'.$data->detail_pemeriksaan_gigi_id.'/edit').'" class="btn btn-sm btn-warning">Edit</a>
                    <button type="submit" data-id="'.$data->sekolah_id.'" data-idDetailPemeriksaanGigi="'.$data->detail_pemeriksaan_gigi_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('kelas_id',function($data){
                return $data->kelas->kelas_name;
            })
            ->editColumn('rujukan',function($data){
                if ($data->rujukan == 0) {
                    return '<span class="badge badge-warning">Perlu dirujuk</span>';
                }else{
                    return '<span class="badge badge-success">Tidak perlu dirujuk</span>';
                }
            })
            ->rawColumns(['rujukan','action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->sekolahId;
        $cek = PemeriksaanGigi::where('sekolah_id',$id)->first();
        
        if (isset($cek) == false) {
            $pemeriksaanGigi = new PemeriksaanGigi;
            $pemeriksaanGigi->sekolah_id = $id;
            $pemeriksaanGigi->save();
        }

        return redirect()->route('periksaGigi',$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$idDetail)
    {
        $detailPemeriksaanGigi = DetailPemeriksaanGigi::with('indekKaries')
                                ->where('detail_pemeriksaan_gigi_id',$idDetail)
                                ->first();
        // return $detailPemeriksaanGigi;
        return view('pemeriksaan.pemeriksaanGigi.edit',compact('detailPemeriksaanGigi'));
    }

    public function indekKariesGd($id)
    {
        $indekKaries = IndekKaries::where('detail_pemeriksaan_gigi_id',$id)->get();
        $columns = $indekKaries->gdTable();
        return $columns;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function siswaByKelasAjax(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::where('kelas_id',$id)->get();

        $option = '';
        for($i=0;$i<count($siswa);$i++)
        {
            $option .= '<option value="'.$siswa[$i]->siswa_id.'">'.$siswa[$i]->nama.'</option>';
        }

        return $option;
    }

    public function detailSiswa(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::where('siswa_id',$id)
                ->with(['kelas' => function($query){
                    $query->with('sekolah');
                }])
                ->first();

        return $siswa;
    }

    public function createPemeriksaanGigi($id)
    {
        $cek = PemeriksaanGigi::where('sekolah_id',$id)->first();
        $kelas = Kelas::where('sekolah_id',$id)->get();

        return view('pemeriksaan.pemeriksaanGigi.create',compact('kelas','id','cek'));
    }

    public function storePemeriksaanGigi(Request $request,$id)
    {
        // return $request->all();

        $detailPemeriksaanGigi = new DetailPemeriksaanGigi;
        $detailPemeriksaanGigi->pemeriksaan_gigi_id = $request->pemeriksaanGigiId;
        $detailPemeriksaanGigi->sekolah_id = $request->sekolahId;
        $detailPemeriksaanGigi->kelas_id = $request->kelasId;
        $detailPemeriksaanGigi->siswa_id = $id;
        $detailPemeriksaanGigi->jumlah_gigi_sulung = $request->jumlahGigiSulung;
        $detailPemeriksaanGigi->jumlah_def_t = $request->jumlahDefT;
        $detailPemeriksaanGigi->def_d = $request->defD;
        $detailPemeriksaanGigi->def_e = $request->defE;
        $detailPemeriksaanGigi->def_f = $request->defF;
        $detailPemeriksaanGigi->exo_pers = $request->exoPers;
        $detailPemeriksaanGigi->jumlah_gigi_permanen = $request->jumlahGigiPermanen;
        $detailPemeriksaanGigi->jumlah_dmf_t = $request->jumlahDmfT;
        $detailPemeriksaanGigi->dmf_d = $request->dmfD;
        $detailPemeriksaanGigi->dmf_m = $request->dmfM;
        $detailPemeriksaanGigi->dmf_f = $request->dmfF;
        $detailPemeriksaanGigi->fs = $request->fs;
        
        for ($i=1; $i <= 6; $i++) { 
            $req = 'debris'.$i;
            $table = 'debris_'.$i;
            $detailPemeriksaanGigi->$table = $request->$req;
        }

        for ($i=1; $i <= 6; $i++) { 
            $req = 'kalkulus'.$i;
            $table = 'kalkulus_'.$i;
            $detailPemeriksaanGigi->$table = $request->$req;
        }

        $detailPemeriksaanGigi->ohiS = $request->ohiS;
        $detailPemeriksaanGigi->kesehatan_gusi = $request->kesehatanGusi;
        $detailPemeriksaanGigi->frekuensi_menyikat_gigi = $request->menyikatGigi;
        $detailPemeriksaanGigi->rujukan = $request->rujukan;
        $detailPemeriksaanGigi->save();

        $detailPemeriksaanGigiId = $detailPemeriksaanGigi->detail_pemeriksaan_gigi_id;
        
        $indekKaries = new IndekKaries;
        $indekKaries->detail_pemeriksaan_gigi_id = $detailPemeriksaanGigiId;
        
        for ($i=11; $i <= 18 ; $i++) { 
            $req = 'gda'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=21; $i <= 28 ; $i++) { 
            $req = 'gda'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=51; $i <= 55 ; $i++) { 
            $req = 'gsa'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=61; $i <= 65 ; $i++) { 
            $req = 'gsa'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=71; $i <= 75 ; $i++) { 
            $req = 'gsb'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=81; $i <= 85 ; $i++) { 
            $req = 'gsb'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=31; $i <= 38 ; $i++) { 
            $req = 'gdb'.$i;
            $indekKaries->$req = $request->$req;
        }

        for ($i=41; $i <= 48 ; $i++) { 
            $req = 'gdb'.$i;
            $indekKaries->$req = $request->$req;
        }

        $indekKaries->save();

        $jumlahSudahDiperiksa = DetailPemeriksaanGigi::where('sekolah_id',$request->sekolahId)
                                ->count();
        $jumlahSiswaBySekolah = Siswa::where('sekolah_id',$request->sekolahId)
                                ->count();

        $pemeriksaanGigi = PemeriksaanGigi::findOrFail($request->pemeriksaanGigiId);
        if ($jumlahSudahDiperiksa == $jumlahSiswaBySekolah) {
            $pemeriksaanGigi->status = '1';
        }else{
            $pemeriksaanGigi->status = '0';
        }
        $pemeriksaanGigi->save();

        return redirect()->route('periksaGigi',$request->sekolahId);
    }
}
