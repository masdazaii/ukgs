<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Schema;

class IndekKaries extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'index_karies';


    /**
     * Table primary key to define table id
     *
     * @var string
     */
    protected $primaryKey = 'index_karies_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detail_pemeriksaan_gigi_id',
        'posisi_gigi',
        'keadaan_gigi',
        'created_at',
        'updated_at',
    ];

    public function gdTable()
    {
    	return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
