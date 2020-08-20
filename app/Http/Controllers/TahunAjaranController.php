<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionHelper;
use Illuminate\Http\Request;
use App\TahunAjaran;
use Validator;
use Response;
use DB;

class TahunAjaranController extends Controller
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
        return view('tahunAjaran.index');
    }

    public function tahunAjaranAjax()
    {
        $data = TahunAjaran::all();

        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                if($data->is_active == 0){
                    $button .= '<button type="submit" data-id="'.$data->tahun_ajaran_id.'" class="btn btn-success btn-sm manage" >Enable</button>';
                }else{
                    $button .= '<button type="submit" data-id="'.$data->tahun_ajaran_id.'" class="btn btn-info btn-sm" >Enabled</button>';
                }
                return $button;
            })
            ->editColumn('tahun_ajaran',function($data){
                return $data->tahun_ajaran;
            })
            ->editColumn('status',function($data){
                if($data->is_active == 0){
                    return '<span class="badge badge-danger">Non Aktif</span>';;
                }else{
                    return '<span class="badge badge-success">Aktif</span>';;
                }
            })
            ->rawColumns(['status','action'])
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
            'tahunAjaran' => 'required'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try{
            $tahunAjaran = new TahunAjaran();
            $tahunAjaran->tahun_ajaran = $request->tahunAjaran;
            $tahunAjaran->save();

            DB::commit();
            return Response::json("Data tahun ajaran berhasil ditambahkan",200);
        }catch(\Exception $e){
            DB::rollback();
            return Response::json("Terdapat kesalahan silahkan hubungi pengembang",500);
        }
    }

    public function manage($tahunAjaranId)
    {
        $tempAjaran = TahunAjaran::where('is_active',1)->first();
        $tahunAjaran = TahunAjaran::findOrFail($tahunAjaranId);

        $tempAjaran->is_active = 0;
        $tempAjaran->save();

        $tahunAjaran->is_active = 1;
        $tahunAjaran->save();

        return Response::json("Tahun ajaran $tahunAjaran->tahun_ajaran berhasil digunakan",200);
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
