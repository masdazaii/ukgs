<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use session;
use DB;
use URL;
use Response;
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
        $data = Kelurahan::all();

        return datatables()->of($data)
        ->addColumn('action',function($data){
                $button = '';
                $button .= '<a href="#" data-id="'.$data->kelurahan_id.'" class="btn btn-sm btn-warning edit"> <i class="fa  fa-edit mr-1"></i>Edit</a>
                                <button type="submit" data-id="'.$data->kelurahan_id.'" class="btn btn-danger btn-sm delete" ><i class="fas fa-trash mr-1 fa-1"></i>Delete</button>';
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
        $kelurahan = new Kelurahan;
        $kelurahan->kelurahan_name = $request->kelurahanName;
        $kelurahan->save();

        return response()->json('success');
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
        // return $request->all();
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->kelurahan_name = $request->kelurahanName;
        $kelurahan->save();

        return Response::json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->delete();
        return Response::json('success');
    }
}
