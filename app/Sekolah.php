<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sekolah';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'sekolah_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sekolah_id',
        'sekolah_name',
        'sekolah_type',
        'npsn',
        'alamat',
        'kecamatan',
        'kota_administrasi',
        'created_at',
        'updated_at',
    ];


    public function pemeriksaanGigi()
    {
        return $this->hasOne('App\PemeriksaanGigi','sekolah_id','sekolah_id');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas','sekolah_id','sekolah_id');
    }
}
