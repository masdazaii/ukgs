<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRujukan extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_rujukan';

    protected $dates = ['deleted_at'];


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'detail_rujukan_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'pemeriksaan_id',
        'penangan',
        'deskripsi'
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','penangan');
    }
}
