<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPemeriksaan extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_pemeriksaan';

    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'jenis_pemeriksaan_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
