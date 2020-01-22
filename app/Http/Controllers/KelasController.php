<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use DB;
use session;
use URL;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $this->validate($request,[
            'sekolahId' => 'required',
            'kelasName' => 'required|string'
        ]);

        $kelas = new Kelas;
        $kelas->sekolah_id = $request->sekolahId;
        $kelas->kelas_name = $request->kelasName;
        $kelas->save();

        return redirect()->back()->with('success','kelas berhasil ditambahkan');
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
        $kelas = Kelas::where('kelas_id',$id)->first();
        return view('kelas.edit',compact('kelas'));
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
        $kelas = Kelas::findOrFail($id);
        $kelas->kelas_name = $request->kelasName;
        $kelas->save();

        return redirect()->back()->with('success','kelas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('success','kelas berhasil dihapus');   
    }

    public function kelasEditAjax(Request $request)
    {
        $id = $request->id;
        $kelas = Kelas::where('kelas_id',$id)->first();
        return $kelas;
    }
}
