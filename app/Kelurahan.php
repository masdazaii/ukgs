<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes,SoftCascadeTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Kelurahan';

    protected $dates = ['deleted_at'];

    protected $softCascade = ['sekolah'];

    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'kelurahan_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'kelurahan_id',
        'kelurahan_name'
    ];

    public function sekolah()
    {
        return $this->hasMany('App\Sekolah','kelurahan','kelurahan_id');
    }
}
