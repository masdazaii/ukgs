<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'tahun_ajaran';

   /**
    * Table primary key to define table id
    *
    * @var string
    */
   protected $primaryKey = 'tahun_ajaran_id';

   public $timestamps = false;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'tahun_ajaran_id',
       'tahun_ajaran',
       'is_active'
   ];
}
