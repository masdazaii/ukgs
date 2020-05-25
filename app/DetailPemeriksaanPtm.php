<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaanPtm extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_ptm';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_pemeriksaan_ptm_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksaan_ptm_id',
        'tekanan_sistolik',
        'tekanan_diastolik',
        'lingkar_pinggang',
        'nilai_gula_darah_sewaktu',
        'created_at',
        'updated_at',
    ];

    public function pemeriksaan()
    {
        return $this->hasOne('App\Pemeriksaan','pemeriksaan_id','pemeriksaan_ptm_id');
    }
}
