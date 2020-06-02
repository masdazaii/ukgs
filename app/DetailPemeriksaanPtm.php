<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPemeriksaanPtm extends Model
{
    use SoftDeletes;
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_ptm';

    protected $dates = ['deleted_at'];

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
