<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Kelas;
use App\Siswa;
use App\KelasMapping;
use App\Imports\SiswaImport;
use App\helpers\FunctionHelper;
use Excel;
use Response;
use session;
use DB;
use URL;

class SiswaController extends Controller
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
    public function index($sekolahId,$kelasId)
    {
        $kelas = Kelas::with('sekolah')
                ->where('sekolah_id',$sekolahId)
                ->where('kelas_id',$kelasId)
                ->first();

        $existingKelas = Kelas::where('sekolah_id',$sekolahId)->get();
        // return $kelas;
        return view('siswa.index',compact('kelas','existingKelas'));
    }

    public function siswaAjax($sekolahId,$kelasId)
    {
        // return $kelasId;
        $data = KelasMapping::where('kelas_id',$kelasId)
                ->where('tahun_pelajaran',FunctionHelper::getTahunPelajaran())
                ->with(['kelas' => function($query){
                            $query->select('kelas_id','kelas_name');
                        }
                        ,'siswa' => function($query){
                            $query->select('siswa_id','nama','nis','nisn','jenis_kelamin');
                        }])
                ->select('kelas_mapping_id','kelas_id','siswa_id','tahun_pelajaran')
                ->get();

                // return $data;
        return datatables()->of($data)
            ->addColumn('action',function($data){
            $button = '';
            $button .= '<a href="#" data-id="'.$data->siswa_id.'" class="btn btn-sm btn-warning edit"> Edit</a>
                        <button data-id="'.$data->siswa_id.'" class="btn btn-danger btn-sm delete" ></i> Delete</button>';
            return $button;
            })
            ->addColumn('check',function(){
                return '<td></td>';
            })
            ->editColumn('kelas_id',function($data){
                return $data->kelas->kelas_name;
            })
            ->editColumn('nis',function($data){
                return $data->siswa->nis;
            })
            ->editColumn('nisn',function($data){
                return $data->siswa->nisn;
            })
            ->editColumn('nama',function($data){
                return $data->siswa->nama;
            })
            ->editColumn('jenis_kelamin',function($data){
                return $data->siswa->jenis_kelamin;
            })
            ->setRowId(function($data) {
                return $data->siswa_id;
            })
            ->rawColumns(['check','action'])
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
        // return $request->all();

        $this->validate($request,[
            'kelasId'=> 'required',
            'siswaName' => 'required',
            'nis' =>'required',
            'nisn' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'agama' => 'required',
            'namaOrangTua' => 'required',
            'alamat' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $siswa = new Siswa;
            $siswa->nama = $request->siswaName;
            $siswa->nis = $request->nis;
            $siswa->nisn = $request->nisn;
            $siswa->jenis_kelamin = $request->jenisKelamin;
            $siswa->tempat_lahir = $request->tempatLahir;
            $siswa->tanggal_lahir = $request->tanggalLahir;
            $siswa->usia = date_diff(date_create($request->tanggalLahir),date_create('today'))->y;
            $siswa->agama = $request->agama;
            $siswa->nama_orang_tua = $request->namaOrangTua;
            $siswa->alamat = $request->alamat;
            $siswa->save();

            $siswaId = $siswa->siswa_id;
            $kelasMapping = new KelasMapping;
            $kelasMapping->kelas_id = $request->kelasId;
            $kelasMapping->siswa_id = $siswaId;
            $kelasMapping->tahun_pelajaran = FunctionHelper::getTahunPelajaran();
            $kelasMapping->save();
            DB::commit();

            return Response::json('Data siswa berhasil ditambahkan',200);
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
        $siswa = Siswa::findOrFail($id);
        return $siswa;
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
            'siswaName' => 'required',
            'nis' =>'required',
            'nisn' => 'required',
            'jenisKelamin' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'agama' => 'required',
            'namaOrangTua' => 'required',
            'alamat' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->nama = $request->siswaName;
            $siswa->nis = $request->nis;
            $siswa->nisn = $request->nisn;
            $siswa->jenis_kelamin = $request->jenisKelamin;
            $siswa->tempat_lahir = $request->tempatLahir;
            $siswa->tanggal_lahir = $request->tanggalLahir;
            $siswa->usia = (date('Y') - date('Y',strtotime($request->tanggalLahir)));
            $siswa->agama = $request->agama;
            $siswa->nama_orang_tua = $request->namaOrangTua;
            $siswa->alamat = $request->alamat;
            $siswa->save();
            DB::commit();

            return Response::json('Data siswa berhasil diubah',200);
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
            $kelasMappingSiswa = KelasMapping::where('siswa_id',$id)->first();
            $kelasMappingSiswa->delete();
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            DB::commit();

            return Response::json('Data siswa berhasil dihapus',200);
        } catch (Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    public function importExcelSiswa(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $kelasId = $request->kelasId;
        if($request->hasFile('file'))
        {
            try {
                $file = $request->file('file');
                Excel::import(new SiswaImport($kelasId),$file);
                return Response::json('Berhasil data siswa excel berhasil dimasukkan',200);
            } catch (Exception $e) {
                return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
            }
        }
    }


    public function naikKelas(Request $request,$sekolahId,$kelasId)
    {
        $siswaNaikKelas = $request->selected;
        $kelasTujuan = $request->kelasTujuan;

        for ($i=0; $i < count($siswaNaikKelas); $i++) { 
            $kelasMapping = new KelasMapping;
            $kelasMapping->siswa_id = $siswaNaikKelas[$i];
            $kelasMapping->kelas_id = $kelasTujuan;
            $kelasMapping->tahun_pelajaran = FunctionHelper::getTahunPelajaran();
            $kelasMapping->save();
        }

        return Response::json('',200);
    }
}
