<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KustomGambar;
use Response;
use DB;
use Image;
use Validator;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('logo.index');
    }

    public function kustomGambarAjax()
    {
        $data = KustomGambar::all();

        return datatables()->of($data)
        ->addColumn('action',function($data){
            $button = '';
            if($data->is_active == 0){
                $button .= '<button type="submit" data-id="'.$data->kustom_gambar_id.'" class="btn btn-success btn-sm manage" >Enable</button>';
            }else{
                $button .= '<button type="submit" data-id="'.$data->kustom_gambar_id.'" class="btn btn-info btn-sm" >Enabled</button>';
            }
            return $button;
        })
        ->editColumn('logo_login',function($data){
            return '<img src="'.$data->logo_login.'">';
        })
        ->editColumn('logo_panel',function($data){
            return '<img src="'.$data->logo_panel.'">';
        })
        ->removeColumn('is_active')
        ->rawColumns(['logo_login','logo_panel','action'])
        ->make(true);
    }

    public function manage($id)
    {
        $gambarAktif = KustomGambar::where('is_active',true)->first();
        $kustomGambar = KustomGambar::findOrFail($id);

        $gambarAktif->is_active = false;
        $kustomGambar->is_active = true;

        $gambarAktif->save();
        $kustomGambar->save();
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
        $validator = Validator::make($request->all(),[
            'loginLogo' => 'required|mimes:png,jpg,jpeg',
            'loginLogo' => 'required|mimes:png,jpg,jpeg',
            'namaPaket' => 'required'
        ]);

        if($validator->fails()){
            return Response::json($validator->messages(),422);
        }

        DB::beginTransaction();
        try {
            $kustomGambar = new KustomGambar;
            $kustomGambar->nama_paket = $request->namaPaket;

            $loginLogo = $request->file('loginLogo');
            $loginLogoName = time().'_' .uniqid().'.'. $loginLogo->getClientOriginalExtension();
            $loginLogoPath = public_path().'/upload/image/loginlogo/';
            $img = Image::make($loginLogo)->fit(100,100, function($constraint){
                $constraint->aspectRatio();
            });
            $img->save($loginLogoPath.$loginLogoName);

            $panelLogo = $request->file('panelLogo');
            $panelLogoName = time().'_' .uniqid().'.'. $panelLogo->getClientOriginalExtension();
            $panelLogoPath = public_path().'/upload/image/panellogo/';
            $img = Image::make($panelLogo)->resize(250,70, function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($panelLogoPath.$panelLogoName);

            $kustomGambar->logo_login = 'upload/image/loginlogo/'.$loginLogoName;
            $kustomGambar->logo_panel = 'upload/image/panellogo/'.$panelLogoName;
            $kustomGambar->is_active = 0;
            $kustomGambar->save();

            DB::commit();
            return Response::json("Data kustomisasi gambar berhasil dimasukkan",200);
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json("terdapat kesalahan, silahkan hubungi pengembang",500);
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
