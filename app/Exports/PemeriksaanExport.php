<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PemeriksaanExport implements FromView,ShouldAutoSize,WithTitle
{
	protected $data;

	public function __construct($collection,$index)
	{
		$this->data = $collection[$index];
	}

	public function title(): string
	{
		return 'Kelas '. $this->data->kelas_name;
	}

    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
    	$kelas = $this->data;
        return view('laporan.excel',compact('kelas'));
    }
}
