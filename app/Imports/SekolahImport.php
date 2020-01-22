<?php

namespace App\Imports;

use App\Sekolah;
use Maatwebsite\Excel\Concerns\ToModel;

class SekolahImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sekolah([
            'sekolah_name' => $row[0],
            'sekolah_type' => $row[1],
            'npsn' => $row[2],
            'alamat' => $row[3],
            'kecamatan' => $row[4],
            'kota_administrasi' => $row[5],
        ]);
    }
}
