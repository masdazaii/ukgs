<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Kelas extends Model
{
    use SoftDeletes,SoftCascadeTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';

    protected $dates = ['deleted_at'];

    protected $softCascade = ['kelasMapping'];

    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'kelas_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_id',
        'sekolah_id',
        'kelas_name',
        'created_at',
        'updated_at',
    ];

    public function sekolah()
    {
        return $this->hasOne('App\Sekolah','sekolah_id','sekolah_id');
    }

    public function kelasMapping()
    {
        return $this->hasMany('App\KelasMapping','kelas_id','kelas_id');
    }
}
