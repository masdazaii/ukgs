<?php

namespace App\Imports;

use DB;
use App\Siswa;
use App\KelasMapping;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection,WithHeadingRow
{
    protected $kelasId;
    public function __construct($kelasId)
    {
        $this->kelasId = $kelasId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                $siswa = new Siswa;
                $siswa->nama = $row['nama'];
                $siswa->nis = $row['nis'];
                $siswa->nisn = $row['nisn'];
                $siswa->jenis_kelamin = $row['jenis_kelamin'];
                $siswa->tempat_lahir = $row['tempat_lahir'];
                $siswa->tanggal_lahir = date("Y-m-d",($row['tanggal_lahir']-25569)*86400);
                $siswa->usia = (date('Y') - date('Y',strtotime($row['tanggal_lahir'])));
                $siswa->agama = $row['agama'];
                $siswa->nama_orang_tua = $row['nama_orang_tua'];
                $siswa->alamat = $row['alamat'];
                $siswa->save();

                $siswaId = $siswa->siswa_id;
                $kelasMapping = new KelasMapping;
                $kelasMapping->kelas_id = $this->kelasId;
                $kelasMapping->siswa_id = $siswaId;
                $kelasMapping->tahun_pelajaran = FunctionHelper::getTahunPelajaran();
                $kelasMapping->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return Response::json("error, pastikan file excel telah sesuai dengan ketentuan",500);
        }
    }
}