<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoalButaWarna extends Model
{
	use SoftDeletes;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'soal_buta_warna';

    protected $dates = ['deleted_at'];
    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'soal_buta_warna_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deskripsi',
        'image',
        'jawaban_benar',
        'created_at',
        'updated_at'
    ];
}
