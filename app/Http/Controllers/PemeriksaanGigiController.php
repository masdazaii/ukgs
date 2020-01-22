<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PemeriksaanGigi;
use App\Sekolah;
use App\Kelas;
use DB;
use URL;
use session;

class PemeriksaanGigiController extends Controller
{
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
    public function store(Request $request,$id)
    {
        $cek = PemeriksaanGigi::where('sekolah_id',$id)->first();
        $kelas = Kelas::where('sekolah_id',$id)->get();
        // return $kelas;
        
        if (isset($cek) == false) {
            $pemeriksaanGigi = new PemeriksaanGigi;
            $pemeriksaanGigi->sekolah_id = $id;
            $pemeriksaanGigi->save();

            return view('pemeriksaan.pemeriksaanGigi.create');
        }

        return view('pemeriksaan.pemeriksaanGigi.create',compact('kelas'));
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
}
