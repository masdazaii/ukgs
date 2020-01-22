<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';


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
        'sekolah_id',
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
        'created_at',
        'updated_at',
    ];

    public function kelas()
    {
        return $this->hasOne('App\Kelas','kelas_id','kelas_id');
    }
}
