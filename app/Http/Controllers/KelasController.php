<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use DB;
use session;
use URL;
use Excel;
use App\Imports\KelasImport;
use Response;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kelasAjax($id)
    {
        $data = Kelas::with('sekolah')
                ->where('sekolah_id',$id)
                ->get();

        // return $data;
        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="'.URL::to('/sekolah/'.$data->sekolah_id.'/kelas/'.$data->kelas_id.'/siswa').'" class="btn btn-sm btn-success"> Siswa</a>
                                <a href="#" data-id="'.$data->kelas_id.'" class="btn btn-sm btn-warning edit"> <i class="fa fa-edit mr-1"></i>Edit</a>
                                <button type="submit" data-id="'.$data->kelas_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
            ->editColumn('sekolah_id',function($data){
                return $data->sekolah->sekolah_name;
            })
            ->removeColumn('created_at','updated_at')
            ->make(true);
    }


    public function importExcelKelas(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|file|mimes:xls,xlsx'
        ]);
        
        try {
            $sekolahId = $request->sekolahId;
            $file = $request->File('file');
            $fileName = rand().$file->getClientOriginalName();
            $file->move('upload/excel',$fileName);

            Excel::import(new KelasImport($sekolahId), public_path('upload/excel/'.$fileName));
            return Response::json('Data dalam excel berhasil ditambahkan',200);
        } catch (\Exception $e) {
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
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
            'sekolahId' => 'required',
            'kelasName' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $kelas = new Kelas;
            $kelas->sekolah_id = $request->sekolahId;
            $kelas->kelas_name = $request->kelasName;
            $kelas->save();
            DB::commit();

            return Response::json('Kelas berhasil ditambahkan',200);
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
        $kelas = Kelas::where('kelas_id',$id)->select('kelas_name','kelas_id')
                ->first();
        return $kelas;
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
            'kelasName' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->kelas_name = $request->kelasName;
            $kelas->save();
            DB::commit();

            return Response::json('Data kelas berhasil diubah',200);
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
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();
            DB::commit();

            return Response::json('Data kelas berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
