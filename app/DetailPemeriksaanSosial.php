<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPemeriksaanSosial extends Model
{
    use SoftDeletes;
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_sosial';

    protected $dates = ['deleted_at'];
    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_pemeriksaan_sosial_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksaan_sosial_id',
        'merokok',
        'minum_alkohol',
        'narkoba',
        'free_sex',
        'created_at',
        'updated_at',
    ];

    public function pemeriksaan()
    {
        return $this->hasOne('App\Pemeriksaan','pemeriksaan_id','pemeriksaan_sosial_id');
    }
}
