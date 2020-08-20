<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use Validator;
use App\Kelurahan;
use App\KelurahanMapping;
use App\Imports\SekolahImport;
use DB;
use URL;
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
        $kelurahan = Kelurahan::all();
        return view('sekolah.index',compact('kelurahan'));
    }

    public function sekolahAjax()
    {
        $data = Sekolah::all();

        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                $button .= ' <a href="' .URL::to('/sekolah/' . $data->sekolah_id . '/kelas'). '" class="btn btn-sm btn-success">Kelas</a>
                            <a href="#" class="btn btn-sm btn-warning edit" data-id="'.$data->sekolah_id.'"><i class="fa fa-edit mr-1"></i> Edit</a>
                            <button data-id="'.$data->sekolah_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1"></i> Delete</button>';
                return $button;
            })
            ->removeColumn('created_at','updated_at')
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
        $validator = Validator::make($request->all(),[
            'npsn' => 'required|int|digits:8',
            'sekolahType' => 'required',
            'sekolahName' => 'required|string',
            'alamat' => 'required|string',
            'kelurahan' => 'required',
            'kecamatan' => 'required|string',
            'kotaAdministrasi' => 'required|string'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try {
            $sekolah = new Sekolah;
            $sekolah->npsn = $request->npsn;
            $sekolah->sekolah_name = $request->sekolahName;
            $sekolah->sekolah_type = $request->sekolahType;
            $sekolah->alamat = $request->alamat;
            $sekolah->kelurahan = $request->kelurahan;
            $sekolah->kecamatan = $request->kecamatan;
            $sekolah->kota_administrasi = $request->kotaAdministrasi;
            $sekolah->save();

            $sekolahId = $sekolah->sekolah_id;
            $kelurahanMapping = new KelurahanMapping;
            $kelurahanMapping->kelurahan_id = $request->kelurahan;
            $kelurahanMapping->sekolah_id = $sekolahId;
            $kelurahanMapping->save();
            DB::commit();
            return Response::json('Data sekolah berhasil ditambahkan',200);
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
        $sekolah = Sekolah::with('kelurahan')->findOrFail($id);
        return $sekolah;
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
        $validator = Validator::make($request->all(),[
            'npsnEdit' => 'required|int|digits:8',
            'sekolahTypeEdit' => 'required',
            'sekolahNameEdit' => 'required|string',
            'kelurahanEdit' => 'required',
            'alamatEdit' => 'required|string',
            'kecamatanEdit' => 'required|string',
            'kotaAdministrasiEdit' => 'required|string'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try {
            $sekolah = Sekolah::findOrFail($id);
            $sekolah->npsn = $request->npsnEdit;
            $sekolah->sekolah_name = $request->sekolahNameEdit;
            $sekolah->sekolah_type = $request->sekolahTypeEdit;
            $sekolah->alamat = $request->alamatEdit;
            $sekolah->kelurahan = $request->kelurahanEdit;
            $sekolah->kecamatan = $request->kecamatanEdit;
            $sekolah->kota_administrasi = $request->kotaAdministrasiEdit;
            $sekolah->save();

            $kelurahanMapping = KelurahanMapping::where('sekolah_id',$id)->first();
            $kelurahanMapping->kelurahan_id = $request->kelurahanEdit;
            $kelurahanMapping->save();
            DB::commit();

            return Response::json('Data sekolah berhasil diubah',200);
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
            $sekolah = Sekolah::findOrFail($id);
            $sekolah->delete();
            DB::commit();

            return Response::json('Data Sekolah berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    public function kelas($sekolahId)
    {
        $sekolah = Sekolah::findOrFail($sekolahId);
        return view('kelas.index',compact('sekolah'));
    }

    public function importExcelSekolah(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            Excel::import(new SekolahImport,$file);
            return Response::json('success',200);
        }
        return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
    }
}
