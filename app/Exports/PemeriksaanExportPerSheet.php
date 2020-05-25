<?php

namespace App\Exports;

use App\Exports\PemeriksaanExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class PemeriksaanExportPerSheet implements WithMultipleSheets
{
	protected $kelas;

	public function __construct($collection)
	{
		$this->kelas = $collection;
	}

    /**
    * @return \Illuminate\Support\Sheets
    */
    public function sheets(): array
    {
        $sheets = [];
        for ($i=0; $i < count($this->kelas) ; $i++) { 
        	$sheets[] = new PemeriksaanExport($this->kelas,$i); 
        }

        return $sheets;
    }
}
