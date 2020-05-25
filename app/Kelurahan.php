<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelurahan';

    protected $dates = ['deleted_at'];

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
}
