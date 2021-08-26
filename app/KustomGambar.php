<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KustomGambar extends Model
{
    protected $table = 'kustom_gambar';

    public $timestamps = false;

    protected $primaryKey = 'kustom_gambar_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'nama_paket',
        'logo_login',
        'logo_panel',
        'is_active'
    ];
}
