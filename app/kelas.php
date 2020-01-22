<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelas';


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
}
