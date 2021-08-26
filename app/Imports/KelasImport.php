<?php

namespace App\Imports;

use DB;
use App\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel,WithHeadingRow
{

    protected $id;
    public function __construct($sekolahId)
    {
        $this->id = $sekolahId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Kelas([
            'sekolah_id' => $this->id,
            'kelas_name' => $row['nama_kelas']
        ]);
    }
}
