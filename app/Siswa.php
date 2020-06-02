<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
class Siswa extends Model
{
    use SoftDeletes,SoftCascadeTrait;
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';

    protected $dates = ['deleted_at'];

    protected $softCascade = ['pemeriksaan','kelasMapping'];


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'siswa_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'nama',
        'nis',
        'nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nama_orang_tua',
        'alamat',
        'usia', 
        'created_at',
        'updated_at',
    ];

    public function kelasMapping()
    {
        return $this->hasMany('App\KelasMapping','siswa_id','siswa_id');
    }

    public function pemeriksaan()
    {
        return $this->hasMany('App\Pemeriksaan','siswa_id','siswa_id');
    }
}
