<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Kelas;
use App\Siswa;
use App\Imports\SiswaImport;
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
        // return $kelas;
        return view('siswa.index',compact('kelas'));
    }

    public function siswaAjax($sekolahId,$kelasId)
    {
        $data = Siswa::with(['kelas' => function($query){
                    $query->with('sekolah');
                }])
                ->where('sekolah_id',$sekolahId)
                ->where('kelas_id',$kelasId)
                ->get();

        return datatables()->of($data)
                ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="#" data-id="'.$data->siswa_id.'" class="btn btn-sm btn-warning edit"> Edit</a>
                            <button data-id="'.$data->siswa_id.'" class="btn btn-danger btn-sm delete" ></i> Delete</button>';
                return $button;
            })
            ->editColumn('sekolah_id',function($data){
                return $data->kelas->sekolah->sekolah_name;
            })  
            ->editColumn('kelas_id',function($data){
                return $data->kelas->kelas_name;
            })
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
            'sekolahId' => 'required',
            'kelasId'=> 'required',
            'sekolahId' => 'required',
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

        $siswa = new Siswa;
        $siswa->sekolah_id = $request->sekolahId;
        $siswa->kelas_id = $request->kelasId;
        $siswa->nama = $request->siswaName;
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->jenis_kelamin = $request->jenisKelamin;
        $siswa->tempat_lahir = $request->tempatLahir;
        $siswa->tanggal_lahir = $request->tanggalLahir;
        $siswa->agama = $request->agama;
        $siswa->nama_orang_tua = $request->namaOrangTua;
        $siswa->alamat = $request->alamat;
        $siswa->save();

        return redirect()->back()->with('success','siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $siswa = Siswa::findOrFail($id);
        $siswa->nama = $request->siswaName;
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->jenis_kelamin = $request->jenisKelamin;
        $siswa->tempat_lahir = $request->tempatLahir;
        $siswa->tanggal_lahir = $request->tanggalLahir;
        $siswa->agama = $request->agama;
        $siswa->nama_orang_tua = $request->namaOrangTua;
        $siswa->alamat = $request->alamat;
        $siswa->save();

        return redirect()->back()->with('success','siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->back()->with('success','data berhasil dihapus');
    }

    public function siswaEditAjax(Request $request)
    {
        $id = $request->id;
        $siswa = Siswa::findOrFail($id);
        return $siswa;
    }

    public function importExcelSiswa(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $kelas = Kelas::findOrFail($request->kelasId);
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            Excel::import(new SiswaImport($kelas),$file);
            return Response::json('success',200);
        }
        return Response::json('error',400);
    }
}
