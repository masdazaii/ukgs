<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class KelasMapping extends Model
{
    use SoftDeletes,SoftCascadeTrait;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas_mapping';

    protected $dates = ['deleted_at'];

    protected $softCascade = ['siswa'];


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'kelas_mapping_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
    ];

    public function kelas()
    {
        return $this->hasOne('App\Kelas','kelas_id','kelas_id');
    }

    public function siswa()
    {
        return $this->hasOne('App\Siswa','siswa_id','siswa_id');
    }
}
