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
        'detail_pemeriksaan_gigi_id',
        'pemeriksaan_gigi_id',
        'exo_pers',
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

    public function pemeriksaan()
    {
        return $this->hasOne('App\Pemeriksaan','pemeriksaan_id','pemeriksaan_gigi_id');
    }

    public function indekKaries()
    {
        return $this->hasMany('App\IndekKaries','detail_pemeriksaan_gigi_id','detail_pemeriksaan_gigi_id');
    }

    public function scopeExclude($query,$value = array())
    {
        return $query->select(array_diff($this->fillable, (array) $value));
    }
}
