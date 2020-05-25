<?php

namespace App\Imports;

use App\Sekolah;
use App\Kelurahan;
use App\Kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SekolahImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $kelurahanId = null;
            $kelurahan = Kelurahan::where('kelurahan_name',strtoupper($row['kelurahan']))
                        ->orWhere('kelurahan_name',strtolower($row['kelurahan']))
                        ->orWhere('kelurahan_name',ucwords($row['kelurahan']))
                        ->first();

            if(!isset($kelurahan)){
                $kelurahanBaru = new Kelurahan;
                $kelurahanBaru->kelurahan_name = $row['kelurahan'];
                $kelurahanBaru->save();

                $kelurahanId = $kelurahanBaru->kelurahan_id;
            }else{
                $kelurahanId = $kelurahan->kelurahan_id;
            }

            $sekolah = Sekolah::create([
                'sekolah_name' => $row['nama_sekolah'],
                'sekolah_type' => $row['tipe_sekolah'],
                'npsn' => $row['npsn'],
                'kelurahan' => $kelurahanId,
                'alamat' => $row['alamat'],
                'kecamatan' => $row['kecamatan'],
                'kota_administrasi' => $row['kota_administrasi'],
            ]);

            $sekolahId = $sekolah->sekolah_id;
            $data = explode(",", $row['kelas']);
            for ($i=0; $i < count($data); $i++) { 
                $kelas = new Kelas;
                $kelas->sekolah_id = $sekolahId;
                $kelas->kelas_name = $data[$i];
                $kelas->save();
            }
        }
    }
}
