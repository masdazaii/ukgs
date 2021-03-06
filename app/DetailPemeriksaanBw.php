<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class DetailPemeriksaanBw extends Model
{
    use SoftDeletes;
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_bw';

    protected $dates = ['deleted_at'];
    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_pemeriksaan_bw_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksaan_bw_id',
        'soal_bw_id',
        'tekanan_diastolik',
        'jawaban',
        'created_at',
        'updated_at',
    ];

    public function soalButaWarna()
    {
    	return $this->hasOne('App\SoalButaWarna','soal_buta_warna_id','soal_bw_id');
    }
}
