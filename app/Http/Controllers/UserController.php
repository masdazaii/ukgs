<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use URL;
use DB;
use session;
use Response;

class UserController extends Controller
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
        return view('user.index');
    }

    public function userAjax()
    {
        $data = User::all();

        return datatables()->of($data)
            ->addColumn('action',function($data){
                $button = '';
                if ($data->status == 1) {
                    $button .= '<button data-id="'.$data->id.'" class="btn btn-danger btn-sm changeStatus" >Disable</button>';
                }else{
                    $button .= '<button data-id="'.$data->id.'" class="btn btn-success btn-sm changeStatus" ></i>Enable</button>';
                }
                return $button;
            })
            ->editColumn('email',function($data){
                return $data->email;
            })
            ->editColumn('name',function($data){
                return $data->name;
            })
            ->editColumn('no_telp',function($data){
                return $data->no_hp;
            })
            ->editColumn('status',function($data){
                if ($data->status == 1) {
                    return '<span class="badge badge-success">Aktif</span>';
                }else{
                    return '<span class="badge badge-danger">Non Aktif</span>';
                }
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $user = User::where('id',$id)->first();
        // return $user;
        if ($user->status == 1) {
            $user->status = false;
            $user->save();
            return Response::json("User telah dinonaktifkan",200);
        }else{
            $user->status = true;
            $user->save();
            return Response::json("User telah diaktifkan",200);
        }
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
        //
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
