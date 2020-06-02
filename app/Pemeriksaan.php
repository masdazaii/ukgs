<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Pemeriksaan extends Model
{

    use SoftDeletes,SoftCascadeTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pemeriksaan';

    protected $dates = ['deleted_at'];

    protected $softCascade = [
        'detailPemeriksaanGigi',
        'detailPemeriksaanImt',
        'detailPemeriksaanSosial',
        'detailPemeriksaanPtm',
        'detailPemeriksaanBw',
        'detailRujukan'
    ];


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'pemeriksaan_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksa_id',
        'siswa_id',
        'jenis_pemeriksaan',
        'rujukan',
        'created_at',
        'updated_at',
    ];

    public function siswa()
    {
        return $this->hasOne('App\Siswa','siswa_id','siswa_id');
    }

    public function pemeriksa()
    {
        return $this->hasOne('App\User','id','pemeriksa_id');
    }

    public function detailPemeriksaanGigi()
    {
        return $this->hasOne('App\DetailPemeriksaanGigi','pemeriksaan_gigi_id','pemeriksaan_id');
    }

    public function detailPemeriksaanImt()
    {
        return $this->hasOne('App\DetailPemeriksaanImt','pemeriksaan_imt_id','pemeriksaan_id');
    }

    public function detailPemeriksaanSosial()
    {
        return $this->hasOne('App\DetailPemeriksaanSosial','pemeriksaan_sosial_id','pemeriksaan_id');
    }

    public function detailPemeriksaanPtm()
    {
        return $this->hasOne('App\DetailPemeriksaanPtm','pemeriksaan_ptm_id','pemeriksaan_id');
    }

    public function detailPemeriksaanBw()
    {
        return $this->hasMany('App\DetailPemeriksaanBw','pemeriksaan_bw_id','pemeriksaan_id');
    }

    public function detailRujukan(){
        return $this->hasOne('App\DetailRujukan','pemeriksaan_id','pemeriksaan_id');
    }

    public function jenisPemeriksaan()
    {
        return $this->hasOne('App\JenisPemeriksaan','jenis_pemeriksaan_id','jenis_pemeriksaan');
    }

}
