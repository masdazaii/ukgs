<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Kelas;
use App\Imports\SekolahImport;
use Alert;
use DB;
use URL;
use session;
use Response;
use Excel;

class SekolahController extends Controller
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
        return view('sekolah.index');
    }

    public function sekolahAjax()
    {
        $data = Sekolah::all();

        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                $button .= ' <a href="' .URL::to('/sekolah/' . $data->sekolah_id . '/kelas'). '" class="btn btn-sm btn-success">Kelas</a>
                            <a href="' .URL::to('/sekolah/' . $data->sekolah_id . '/edit'). '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i> Edit</a>
                            <button data-id="'.$data->sekolah_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i> Delete</button>';
                return $button;
            })
            ->removeColumn('created_at','updated_at')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekolah.create');
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
            'npsn' => 'required|int',
            'sekolahType' => 'required',
            'sekolahName' => 'required|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kotaAdministrasi' => 'required|string'
        ]);

        $sekolah = new Sekolah;
        $sekolah->npsn = $request->npsn;
        $sekolah->sekolah_name = $request->sekolahName;
        $sekolah->sekolah_type = $request->sekolahType;
        $sekolah->alamat = $request->alamat;
        $sekolah->kecamatan = $request->kecamatan;
        $sekolah->kota_administrasi = $request->kotaAdministrasi;
        $sekolah->save();

        return redirect()->route('sekolah.index')->with('success','Data sekolah berhasil ditambahkan'); 
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
    public function edit($id)
    {
        $tipeSekolah = [
            '0' => 'SD',
            '1' => 'SMP',
            '2' => 'SMA'
        ];
        $sekolah = Sekolah::findOrFail($id);
        return view('sekolah.edit',compact('sekolah','tipeSekolah'));
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
            'npsn' => 'required|int',
            'sekolahType' => 'required',
            'sekolahName' => 'required|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kotaAdministrasi' => 'required|string'
        ]);

        $sekolah = Sekolah::findOrFail($id);
        $sekolah->npsn = $request->npsn;
        $sekolah->sekolah_name = $request->sekolahName;
        $sekolah->sekolah_type = $request->sekolahType;
        $sekolah->alamat = $request->alamat;
        $sekolah->kecamatan = $request->kecamatan;
        $sekolah->kota_administrasi = $request->kotaAdministrasi;
        $sekolah->save();

        return redirect()->route('sekolah.index')->with('success','Data sekolah berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();

        return redirect()->route('sekolah.index')->with('success','Data sekolah berhasil dihapus'); 
    }

    public function kelas($sekolahId)
    {
        $sekolah = Sekolah::findOrFail($sekolahId);
        return view('kelas.index',compact('sekolah'));
    }

    public function importExcelSekolah(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            Excel::import(new SekolahImport,$file);
            return Response::json('success',200);
        }
        return Response::json('error',400);
    }
}