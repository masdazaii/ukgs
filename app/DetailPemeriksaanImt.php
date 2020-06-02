<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPemeriksaanImt extends Model
{
    use SoftDeletes;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_pemeriksaan_imt';

    protected $dates = ['deleted_at'];

    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_pemeriksaan_imt_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemeriksaan_imt_id',
        'tinggi_badan',
        'berat_badan',
        'vaksin',   
        'created_at',
        'updated_at',
    ];

    public function pemeriksaan()
    {
        return $this->hasOne('App\Pemeriksaan','pemeriksaan_id','pemeriksaan_imt_id');
    }
}
