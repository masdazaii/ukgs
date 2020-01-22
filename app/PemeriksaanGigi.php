<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanGigi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pemeriksaan_gigi';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'pemeriksaan_gigi_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sekolah_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
