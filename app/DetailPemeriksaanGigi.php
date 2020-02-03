<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaanGigi extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_gigi';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_pemeriksaan_gigi_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksaan_gigi_id',
        'sekolah_id',
        'kelas_id',
        'siswa_id',
        'jumlah_gigi_sulung',
        'jumlah_def_t',
        'def_d',
        'def_f',
        'def_e',
        'exo_pers',
        'jumlah_gigi_permanen',
        'jumlah_dmf_t',
        'dmf_d',
        'dmf_m',
        'dmf_f',
        'fs',
        'debris_1',
        'debris_2',
        'debris_3',
        'debris_4',
        'debris_5',
        'debris_6',
        'kalkulus_1',
        'kalkulus_2',
        'kalkulus_3',
        'kalkulus_4',
        'kalkulus_5',
        'kalkulus_6',
        'ohis',
        'kesehatan_gusi',
        'frekuensi_menyikat_gigi',
        'rujukan',
        'created_at',
        'updated_at',
    ];

    public function siswa()
    {
        return $this->hasOne('App\Siswa','siswa_id','siswa_id');
    }

    public function kelas()
    {
        return $this->hasOne('App\Kelas','kelas_id','kelas_id');
    }

    public function indekKaries()
    {
        return $this->hasOne('App\IndekKaries','detail_pemeriksaan_gigi_id','detail_pemeriksaan_gigi_id');
    }
}
