<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemeriksaan;
use App\Sekolah;
use App\Kelas;
use App\Siswa;
use App\DetailPemeriksaanGigi;
use App\indekKaries;
use App\KelasMapping;
use App\DetailRujukan;
use App\Helpers\FunctionHelper;
use DB;
use URL;
use session;
use Auth;
use Response;

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

    public function detailPemeriksaanGigiAjax($id,$sekolahId)
    {
        $data = Pemeriksaan::where('jenis_pemeriksaan',$id)
                ->with(['detailRujukan',
                    'detailPemeriksaanGigi' => function($query){
                        $query->select('pemeriksaan_gigi_id','ohis');
                    },'pemeriksa' => function($query){
                        $query->select('id','name');
                    }, 'siswa' => function($query){
                        $query->select('siswa_id','nama');
                    }])
                ->whereHas('siswa', function($query) use ($sekolahId){
                    $query->whereHas('kelasMapping', function($query) use ($sekolahId){
                        $query->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran());
                        $query->whereHas('kelas', function($query) use ($sekolahId){
                            $query->where('sekolah_id',$sekolahId);
                        });
                    });
                })
                ->select('pemeriksaan_id','pemeriksa_id','siswa_id','rujukan','jenis_pemeriksaan','created_at')
                ->orderBy('created_at','DESC');

        return datatables()->of($data)
            ->addColumn('action',function($data) use ($id){
                $button = '';
                $button .= '
                    <button data-idPemeriksaanGigi="'.$data->pemeriksaan_id.'" class="btn btn-success btn-sm detail" >Detail</button>
                    <a href="'.URL::to('/pemeriksaan/'.$id.'/periksa/'.$data->siswa->kelasMapping[0]->kelas->sekolah_id.'/detailPemeriksaanGigi/'.$data->pemeriksaan_id.'/edit').'" class="btn btn-sm btn-warning">Edit</a>
                    <button data-idPemeriksaanGigi="'.$data->pemeriksaan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('siswa_id',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('pemeriksa_id',function($data){
                return $data->pemeriksa->name;
            })
            ->editColumn('ohis',function($data){
                return $data->detailPemeriksaanGigi->ohis;
            })
            ->editColumn('rujukan',function($data){
                if ($data->rujukan == 1) {
                    return '<span class="badge badge-warning">Perlu dirujuk</span>';
                }else{
                    return '<span class="badge badge-success">Tidak perlu dirujuk</span>';
                }
            })
            ->rawColumns(['rujukan','action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemeriksaanGigi = Pemeriksaan::where('pemeriksaan_id',$id)
                            ->with(['detailPemeriksaanGigi' => function($query){
                                $query->select('detail_pemeriksaan_gigi_id','pemeriksaan_gigi_id','exo_pers','fs','ohis','kesehatan_gusi','frekuensi_menyikat_gigi');
                                $query->with('indekKaries');
                            },'siswa' => function($query){
                                $query->select('siswa_id','nama','nis','jenis_kelamin','usia');
                            }])
                            ->select('pemeriksaan_id','pemeriksa_id','siswa_id','rujukan')
                            ->first();

        $olah = FunctionHelper::olahIndekKaries($pemeriksaanGigi->detailPemeriksaanGigi->indekKaries);

        unset($pemeriksaanGigi->detailPemeriksaanGigi->indekKaries);

        $pemeriksaanGigi->detailPemeriksaanGigi->indekkaries = $olah;

        return $pemeriksaanGigi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$sekolahId,$idPemeriksaanGigi)
    {
        $pemeriksaanGigi = Pemeriksaan::where('pemeriksaan_id',$idPemeriksaanGigi)
                            ->with(['detailRujukan','detailPemeriksaanGigi' => function($query){
                                $query->with('indekKaries');
                            }])
                            ->first();

        $indekKaries = $pemeriksaanGigi->detailPemeriksaanGigi->indekKaries;
        $posisiGd = [];
        $posisiGs = [];
        $keadaanGd = [];
        $keadaanGs = [];
        $defD = 0;
        $defE = 0;
        $defF = 0;
        $dmfD = 0;
        $dmfM = 0;
        $dmfF = 0;
        $debrisKalkulus = [];
        $debrisKalkulusValue = [];

        for ($i=1; $i < 7; $i++) { 
            $debris = 'debris'.$i;
            $param = 'debris_'.$i;
            array_push($debrisKalkulus, $debris);
            array_push($debrisKalkulusValue,$pemeriksaanGigi->detailPemeriksaanGigi->$param);
        }

        for ($i=1; $i < 7; $i++) { 
            $kalkulus = 'kalkulus'.$i;
            $param = 'kalkulus_'.$i;
            array_push($debrisKalkulus, $kalkulus);
            array_push($debrisKalkulusValue,$pemeriksaanGigi->detailPemeriksaanGigi->$param);
        }

        for ($i=0; $i < count($indekKaries) ; $i++) { 
            if (substr($indekKaries[$i]->posisi_gigi,0,2) == "gd" ) {
                array_push($posisiGd,$indekKaries[$i]->posisi_gigi);
                array_push($keadaanGd,$indekKaries[$i]->keadaan_gigi);
                if ($indekKaries[$i]->keadaan_gigi == 2) {
                    $dmfD++;
                }else if($indekKaries[$i]->keadaan_gigi == 3){
                    $dmfM++;
                }else if($indekKaries[$i]->keadaan_gigi == 4){
                    $dmfF++;
                }
            }else{
                array_push($posisiGs,$indekKaries[$i]->posisi_gigi);
                array_push($keadaanGs,$indekKaries[$i]->keadaan_gigi);
                if ($indekKaries[$i]->keadaan_gigi == 2) {
                    $defD++;
                }else if($indekKaries[$i]->keadaan_gigi == 3){
                    $defE++;
                }else if($indekKaries[$i]->keadaan_gigi == 4){
                    $defF++;
                }
            }
        }
        return view('pemeriksaan.pemeriksaanGigi.edit',compact('id','sekolahId','pemeriksaanGigi','posisiGd','posisiGs','keadaanGd','keadaanGs','defD','defE','defF','dmfD','dmfM','dmfF','debrisKalkulus','debrisKalkulusValue'));
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
            'fs' => 'required',
            'exoPers' => 'required',
            'debris1' => 'required',
            'debris2' => 'required',
            'debris3' => 'required',
            'debris4' => 'required',
            'debris5' => 'required',
            'debris6' => 'required',
            'kalkulus1' => 'required',
            'kalkulus2' => 'required',
            'kalkulus3' => 'required',
            'kalkulus4' => 'required',
            'kalkulus5' => 'required',
            'kalkulus6' => 'required',
            'ohiS' => 'required',
            'kesehatanGusi' => 'required',
            'menyikatGigi' => 'required|string',
            'rujukan' => 'required',
            'gigiJson' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaanGigi = Pemeriksaan::findOrFail($id);
            $pemeriksaanGigi->pemeriksa_id = Auth::user()->id;
            $pemeriksaanGigi->rujukan = $request->rujukan;
            $pemeriksaanGigi->save();

            $detailPemeriksaanGigi = DetailPemeriksaanGigi::where('pemeriksaan_gigi_id',$id)->first();
            $detailPemeriksaanGigi->exo_pers = $request->exoPers;
            $detailPemeriksaanGigi->fs = $request->fs;

            if ($request->rujukan == 1) {
                if ($pemeriksaanGigi->rujukan == 0) {
                    $rujukan = new DetailRujukan;
                    $rujukan->pemeriksaan_id = $id;
                    $rujukan->deskripsi = $request->deskripsi;
                    $rujukan->save();
                }else{
                    $rujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    $rujukan->deskripsi = $request->deskripsi;
                    $rujukan->save(); 
                }
            }else{
                if ($pemeriksaanGigi->rujukan == 1) {
                    $rujukan = DetailRujukan::where('pemeriksaan_id',$id)->first();
                    $rujukan->delete();
                    $pemeriksaanGigi->rujukan = 0;
                }
            }
            
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
            $detailPemeriksaanGigi->save();

            $detailPemeriksaanGigiId = $detailPemeriksaanGigi->detail_pemeriksaan_gigi_id;

            $deleteIndekKaries = IndekKaries::where('detail_pemeriksaan_gigi_id',$detailPemeriksaanGigiId)
                                ->delete();

            $gigiJson = $request->gigiJson;
            for ($i=0; $i < count($gigiJson) ; $i++) {
                $indekKaries = new IndekKaries;
                $indekKaries->detail_pemeriksaan_gigi_id = $detailPemeriksaanGigiId;
                $indekKaries->keadaan_gigi = $gigiJson[$i]['keadaanGigi'];
                $indekKaries->posisi_gigi = $gigiJson[$i]['posisiGigi'];
                $indekKaries->save();
            }
            DB::commit();

            return Response::json('Data pemeriksaan gigi berhasil diubah',200);
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
            $pemeriksaanGigi = Pemeriksaan::findOrFail($id);
            $pemeriksaanGigi->delete();
            DB::commit();

            return Response::json('Data pemeriksaan gigi berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    public function storePemeriksaanGigi(Request $request,$id)
    {
        $this->validate($request,[
            'jenisPemeriksaan' => 'required',
            'fs' => 'required',
            'exoPers' => 'required',
            'debris1' => 'required',
            'debris2' => 'required',
            'debris3' => 'required',
            'debris4' => 'required',
            'debris5' => 'required',
            'debris6' => 'required',
            'kalkulus1' => 'required',
            'kalkulus2' => 'required',
            'kalkulus3' => 'required',
            'kalkulus4' => 'required',
            'kalkulus5' => 'required',
            'kalkulus6' => 'required',
            'ohiS' => 'required',
            'kesehatanGusi' => 'required',
            'menyikatGigi' => 'required|string',
            'rujukan' => 'required',
            'gigiJson' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $pemeriksaan = new Pemeriksaan;
            $pemeriksaan->pemeriksa_id = Auth::user()->id;
            $pemeriksaan->siswa_id = $id;
            $pemeriksaan->jenis_pemeriksaan = $request->jenisPemeriksaan;
            $pemeriksaan->rujukan = $request->rujukan;
            $pemeriksaan->save();

            $pemeriksaanId = $pemeriksaan->pemeriksaan_id;

            if ($request->rujukan == 1) {
                $rujukan = new DetailRujukan;
                $rujukan->pemeriksaan_id = $pemeriksaanId;
                if (isset($request->deskripsi)) {
                    $rujukan->deskripsi = $request->deskripsi;
                }
                $rujukan->save(); 
            }

            $detailPemeriksaanGigi = new DetailPemeriksaanGigi;
            $detailPemeriksaanGigi->pemeriksaan_gigi_id = $pemeriksaanId;
            $detailPemeriksaanGigi->exo_pers = $request->exoPers;
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
            $detailPemeriksaanGigi->save();

            $detailPemeriksaanGigiId = $detailPemeriksaanGigi->detail_pemeriksaan_gigi_id;
            $gigiJson = $request->gigiJson;
            for ($i=0; $i < count($gigiJson) ; $i++) {
                $indekKaries = new IndekKaries;
                $indekKaries->detail_pemeriksaan_gigi_id = $detailPemeriksaanGigiId;
                $indekKaries->keadaan_gigi = $gigiJson[$i]['keadaanGigi'];
                $indekKaries->posisi_gigi = $gigiJson[$i]['posisiGigi'];
                $indekKaries->save();
            }

            DB::commit();
            return Response::json('Data pemeriksaan gigi berhasil disimpan',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
