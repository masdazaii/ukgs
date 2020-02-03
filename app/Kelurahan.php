<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Kelurahan';


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
