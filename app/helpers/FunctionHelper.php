<?php

namespace App\Helpers;

use App\TahunAjaran;
use App\Pemeriksaan;
use App\DetailPemeriksaanGigi;
use App\DetailPemeriksaanImt;
use App\DetailPemeriksaanSosial;
use App\DetailPemeriksaanPtm;
use App\KustomGambar;
use Carbon\Carbon;

class FunctionHelper
{
	public static function getTahunPelajaran()
	{
        $tahunPelajaran = TahunAjaran::where('is_active',1)->select('tahun_ajaran_id')->first();

		return $tahunPelajaran->tahun_ajaran_id;
	}

    public static function getTahunPelajaranDate()
	{
        $tahunPelajaran = TahunAjaran::where('is_active',1)->select('tahun_ajaran')->first();

		return $tahunPelajaran->tahun_ajaran;
    }

	public static function olahIndekKaries($collection)
	{
		$def = 0;
        $dmf = 0;
        $defD = 0;
        $defE = 0;
        $defF = 0;
        $dmfF = 0;
        $dmfM = 0;
        $dmfD = 0;

        for ($i=0; $i < count($collection); $i++) {
            if (strpos($collection[$i]->posisi_gigi , 'gd') !== false) {
                $dmf++;
                if ($collection[$i]->keadaan_gigi == 2) {
                    $dmfD++;
                }elseif ($collection[$i]->keadaan_gigi == 3) {
                    $dmfM++;
                }else if($collection[$i]->keadaan_gigi == 4){
                    $dmfF++;
                }
            }else if(strpos($collection[$i]->posisi_gigi , 'gs') !== false){
                $def++;
                if ($collection[$i]->keadaan_gigi == 2) {
                    $defD++;
                }elseif ($collection[$i]->keadaan_gigi == 3) {
                    $defE++;
                }else if($collection[$i]->keadaan_gigi == 4){
                    $defF++;
                }
            }
        }

        $arr = [
            'jumlahDmf' => $dmf,
            'jumlahDef' => $def,
            'skorDefT' => $defD+$defE+$defF,
            'skorDmfT' => $dmfD+$dmfM+$dmfF,
            'defD' => $defD,
            'defE' => $defE,
            'defF' => $defF,
            'dmfD' => $dmfD,
            'dmfM'=> $dmfM,
            'dmfF' => $dmfF
        ];

        $obj = (Object) $arr;

        return $obj;
	}

    public static function cekStatusImt($collection)
    {
        $result = [
            "sangatKurus" => 0,
            "kurus" => 0,
            "normal" => 0,
            "gemuk" => 0,
            "sangatGemuk" => 0
        ];

        for ($i=0; $i < count($collection); $i++) {
            $calcTb = $collection[$i]->tinggi_badan/100;
            $calcImt = number_format($collection[$i]->berat_badan/($calcTb*$calcTb),1);
            if ($calcImt < 17) {
                $result["sangatKurus"] += 1;
            }else if($calcImt >= 17 && $calcImt <= 18.4 ){
                $result["kurus"] += 1;
            }else if($calcImt >= 18.5 && $calcImt <= 25 ){
                $result["normal"] += 1;
            }else if($calcImt >= 25.1 && $calcImt <= 27 ){
                $result["gemuk"] += 1;
            }else{
                $result["sangatGemuk"] += 1;
            }
        }

        return $result;
    }

    public static function sosialFilter($collection)
    {
        $result = [
            "merokok" => 0,
            "sexBebas" => 0,
            "minumAlkohol" => 0,
            "narkoba" => 0
        ];

        for ($i=0; $i < count($collection) ; $i++) {
            if ($collection[$i]->merokok == 1) {
                $result["merokok"] += 1;
            }
            if($collection[$i]->free_sex == 1){
                $result["sexBebas"] += 1;
            }
            if($collection[$i]->minum_alkohol == 1){
                $result["minumAlkohol"] += 1;
            }
            if($collection[$i]->narkoba == 1){
                $result["narkoba"] += 1;
            }
        }

        return $result;
    }

    public static function kesehatanGusiStatus($collection)
    {
        $result = [
            "baik" => 0,
            "cukup" => 0,
            "kurang" => 0,
            "jelek" => 0
        ];

        for ($i=0; $i < count($collection) ; $i++) {
            if ($collection[$i]->kesehatan_gusi == 0) {
                $result["baik"] += 1;
            }elseif ($collection[$i]->kesehatan_gusi == 1) {
                $result["cukup"] += 1;
            }elseif ($collection[$i]->kesehatan_gusi == 2) {
                $result["kurang"] += 1;
            }else{
                $result["jelek"] += 1;
            }
        }

        return $result;
    }

    public static function createdatConverter($time)
    {
        $month = Carbon::parse($time)->format('m');
        $year = Carbon::parse($time)->format('Y');

        $tempYear = null;
        $tahunPelajaran = null;

        if($month < 6){
            $tempYear = $year - 1;
            $tahunPelajaran = $tempYear.'/'.$year;
        }else{
            $tempYear = $year + 1;
            $tahunPelajaran = $year.'/'.$tempYear;
        }

        return $tahunPelajaran;
    }


    public static function pemeriksaanMapping($collection)
    {
        $data = [];
        for($i=0;$i< count($collection); $i++){
            if ($collection[$i]['jenis_pemeriksaan'] == 1) {
                $deskripsi = DetailPemeriksaanGigi::withTrashed()
                            ->where('pemeriksaan_gigi_id',$collection[$i]['pemeriksaan_id'])
                            ->select('detail_pemeriksaan_gigi_id','pemeriksaan_gigi_id','exo_pers','fs','ohis','kesehatan_gusi','frekuensi_menyikat_gigi')
                            ->with(['indekKaries' => function($query){
                                $query->withTrashed();
                                $query->select('detail_pemeriksaan_gigi_id','posisi_gigi','keadaan_gigi');
                            }])
                            ->first();
                
                $indekKaries = Self::olahIndekKaries($deskripsi->indekKaries);

                $arr = [
                    'jumlahDmf' => $indekKaries->jumlahDmf,
                    'jumlahDef' => $indekKaries->jumlahDef,
                    'skorDefT' => $indekKaries->skorDefT,
                    'skorDmfT' => $indekKaries->skorDmfT,
                    'defD' => $indekKaries->defD,
                    'defE' => $indekKaries->defE,
                    'defF' => $indekKaries->defF,
                    'dmfD' => $indekKaries->dmfD,
                    'dmfM'=> $indekKaries->dmfM,
                    'dmfF' => $indekKaries->dmfF,
                    'ohis' => $deskripsi->ohis,
                    'fs' => $deskripsi->fs,
                    'exoPers' => $deskripsi->exo_pers,
                    'kesehatanGusi' =>$deskripsi->kesehatan_gusi,
                    'frekuensiMenyikatGigi' => $deskripsi->frekuensi_menyikat_gigi
                ];

                $obj = (Object)$arr;
                $collection[$i]['detail'] = $obj;
                $data['pemeriksaangigi'] = $collection[$i]['detail'];
            }else if($collection[$i]['jenis_pemeriksaan'] == 2){
                $deskripsi = DetailPemeriksaanImt::withTrashed()
                            ->where('pemeriksaan_imt_id',$collection[$i]['pemeriksaan_id'])
                            ->select('berat_badan','tinggi_badan','vaksin')
                            ->first();
                $imt = round($deskripsi->berat_badan/(($deskripsi->tinggi_badan/100)*($deskripsi->tinggi_badan/100)),1);
                if($imt < 17){
                    $deskripsi->status = "sangat kurus";
                }else if($imt >= 17 && $imt <= 18.4 ){
                    $deskripsi->status = "kurus";
                }else if($imt >= 18.5 && $imt <= 25 ){
                    $deskripsi->status = "normal";
                }else if($imt >= 25.1 && $imt <= 27 ){
                    $deskripsi->status = "gemuk";
                }else{
                    $deskripsi->status = "sangat gemuk";
                }

                $collection[$i]['detail'] = $deskripsi;

                $data['pemeriksaanimt'] = $collection[$i]['detail'];
            }else if($collection[$i]['jenis_pemeriksaan'] == 3){
                $deskripsi = DetailPemeriksaanSosial::withTrashed()
                            ->where('pemeriksaan_sosial_id',$collection[$i]['pemeriksaan_id'])
                            ->select('merokok','minum_alkohol','narkoba','free_sex')
                            ->first();

                $collection[$i]['detail'] = $deskripsi;
                $data['pemeriksaansosial'] = $collection[$i]['detail'];
            }else if($collection[$i]['jenis_pemeriksaan'] == 4){
                $deskripsi = DetailPemeriksaanPtm::withTrashed()
                            ->where('pemeriksaan_ptm_id',$collection[$i]['pemeriksaan_id'])
                            ->select('tekanan_sistolik','tekanan_diastolik','nilai_gula_darah_sewaktu','lingkar_pinggang')
                            ->first();

                $collection[$i]['detail'] = $deskripsi;
                $data['pemeriksaanptm'] = $collection[$i]['detail'];
            }else if($collection[$i]['jenis_pemeriksaan'] == 5){
                $deskripsi = Pemeriksaan::withTrashed()
                            ->where('pemeriksaan_id',$collection[$i]['pemeriksaan_id'])
                            ->select('pemeriksaan_id','siswa_id','jenis_pemeriksaan','rujukan')
                            ->first();
                $collection[$i]['detail'] = $deskripsi;
                $data['pemeriksaanbw'] = $collection[$i]['detail'];
            }
        }

        return $data;
    }

    public static function getLoginLogoActive()
    {
        $gambarAktif = KustomGambar::where('is_active',true)
                        ->first();
        $loginLogoPath = $gambarAktif->logo_login;
        return $loginLogoPath;
    }

    public static function getPanelLogoActive()
    {
        $gambarAktif = KustomGambar::where('is_active',true)
                        ->first();
        $panelLogoPath = $gambarAktif->logo_panel;
        return $panelLogoPath;
    }
}
