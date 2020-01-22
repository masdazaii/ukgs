<?php

namespace App\Imports;

use App\Siswa;
use App\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    protected $kelas;
    public function __construct(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'sekolah_id' => $this->kelas->sekolah_id,
            'kelas_id' => $this->kelas->kelas_id,
            'nama' => $row[0],
            'nis' => $row[1],
            'nisn' => $row[2],
            'jenis_kelamin' => $row[3],
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => date("Y-m-d",($row[5]-25569)*86400),
            'agama' => $row[6],
            'nama_orang_tua' => $row[7],
            'alamat' => $row[8],
        ]);
    }
}
