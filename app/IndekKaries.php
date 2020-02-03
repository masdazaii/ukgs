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
        'gda11',
        'gda12',
        'gda13',
        'gda14',
        'gda15',
        'gda16',
        'gda17',
        'gda18',
        'gda21',
        'gda22',
        'gda23',
        'gda24',
        'gda25',
        'gda26',
        'gda27',
        'gda28',
        'gsa51',
        'gsa52',
        'gsa53',
        'gsa54',
        'gsa55',
        'gsa61',
        'gsa62',
        'gsa63',
        'gsa64',
        'gsa65',
        'gsb71',
        'gsb72',
        'gsb73',
        'gsb74',
        'gsb75',
        'gsb81',
        'gsb82',
        'gsb83',
        'gsb84',
        'gsb85',
        'gdb31',
        'gdb32',
        'gdb33',
        'gdb34',
        'gdb35',
        'gdb36',
        'gdb37',
        'gdb38',
        'gdb41',
        'gdb42',
        'gdb43',
        'gdb44',
        'gdb45',
        'gdb46',
        'gdb47',
        'gdb48',
        'created_at',
        'updated_at',
    ];

    public function gdTable()
    {
    	return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
