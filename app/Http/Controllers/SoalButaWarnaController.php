<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoalButaWarna;
use Response;
use Session;
use URL;
use DB;
use File;

class SoalButaWarnaController extends Controller
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
        return view('soalButaWarna.index');
    }

    public function soalButaWarnaAjax()
    {
        $data = SoalButaWarna::all();
        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="#" data-id="'.$data->soal_buta_warna_id.'" class="btn btn-sm btn-warning edit"> Edit</a>
                        <button data-id="'.$data->soal_buta_warna_id.'" class="btn btn-danger btn-sm delete" ></i> Delete</button>';
                return $button;
            })
        ->editColumn('image',function($data){
            return '<img src="'.$data->image.'" height="100px" width="100px">';
        })
        ->rawColumns(['image','action'])
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
        $this->validate($request,[
            'deskripsi' => 'required',
            'jawabanBenar' =>'required',
            'file' =>'required|mimes: jpg,jpeg,png'
        ]);

        DB::beginTransaction();
        try {
            $soalButaWarna = new SoalButaWarna;
            $soalButaWarna->deskripsi = $request->deskripsi;
            $soalButaWarna->jawaban_benar = $request->jawabanBenar;
            
            $file = $request->file('file');
            $fileName = time().'_' .uniqid().'.'. $file->getClientOriginalExtension();
            $imagePath = public_path().'/upload/image/';
            $file->move($imagePath,$fileName);
            $soalButaWarna->image = 'upload/image/'.$fileName;
            $soalButaWarna->save();
            DB::commit();

            return Response::json('Soal buta warna berhasil ditambahkan',200);
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
        $bw = SoalButaWarna::findOrFail($id);
        return $bw;
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
            'deskripsi' => 'required',
            'jawabanBenar' =>'required',
        ]);

        DB::beginTransaction();
        try {
            $soalButaWarna = SoalButaWarna::findOrFail($id);
            $soalButaWarna->deskripsi = $request->deskripsi;
            $soalButaWarna->jawaban_benar = $request->jawabanBenar;

            if($request->hasFile('file')){
                $path = $soalButaWarna->image;
                if(File::exists($path)){
                    File::delete($path);
                }

                $file = $request->file('file');
                $fileName = time().'_' .uniqid().'.'. $file->getClientOriginalExtension();
                $imagePath = public_path().'/upload/image/';
                $file->move($imagePath,$fileName);
                $soalButaWarna->image = 'upload/image/'.$fileName;
            }
            
            $soalButaWarna->save();
            DB::commit();

            return Response::json('Soal buta warna berhasil diubah',200);
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
            $soalButaWarna = SoalButaWarna::findOrFail($id);
            $soalButaWarna->delete();
            DB::commit();

            return Response::json('Soal buta warna berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
