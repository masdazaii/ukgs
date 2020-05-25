<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sekolah';

    protected $dates = ['deleted_at'];


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
        'kelurahan',
        'alamat',
        'kecamatan',
        'kota_administrasi',
        'created_at',
        'updated_at',
    ];

    public function kelas()
    {
        return $this->hasMany('App\Kelas','sekolah_id','sekolah_id');
    }

    public function kelurahan()
    {
        return $this->hasOne('App\Kelurahan','kelurahan_id','kelurahan');
    }
}
