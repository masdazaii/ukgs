<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Validator;
use App\Kelurahan;

class KelurahanController extends Controller
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
        return view('kelurahan.index');
    }

    public function kelurahanAjax()
    {
        $data = Kelurahan::select('kelurahan_id','kelurahan_name');

        return datatables()->of($data)
        ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="#" data-id="'.$data->kelurahan_id.'" class="btn btn-sm btn-warning edit"> <i class="fa  fa-edit mr-1"></i>Edit</a>
                                <button type="submit" data-id="'.$data->kelurahan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
                return $button;
            })
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
            'kelurahanName' => 'required'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try {
            $kelurahan = new Kelurahan;
            $kelurahan->kelurahan_name = $request->kelurahanName;
            $kelurahan->save();
            DB::commit();
            return Response::json('Data kelurahan berhasil ditambahkan',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        return $kelurahan;
    }

    public function kelurahanEditAjax(Request $request)
    {
        $id = $request->id;
        $kelurahan = Kelurahan::findOrFail($id);
        return $kelurahan;
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
            'kelurahanName' => 'required'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try {
            $kelurahan = Kelurahan::findOrFail($id);
            $kelurahan->kelurahan_name = $request->kelurahanName;
            $kelurahan->save();
            DB::commit();

            return Response::json('Data kelurahan berhasil diubah',200);
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
            $kelurahan = Kelurahan::findOrFail($id);
            $kelurahan->delete();
            DB::commit();
            
            return Response::json('Data kelurahan berhasil dihapus',200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json('Terdapat kesalahan,silahkan hubungi pengembang',500);
        }
    }
}
