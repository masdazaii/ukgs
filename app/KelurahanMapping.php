<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelurahanMapping extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelurahan_mapping';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'kelurahan_mapping_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = [
        'kelurahan_id',
        'sekolah_id',
    ];
}
