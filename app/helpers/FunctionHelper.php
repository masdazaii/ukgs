<?php

namespace app\helpers;

use app\Sekolah;
use app\Kelas;
use app\KelasMapping;
use app\Siswa;
use app\Pemeriksaan;

class FunctionHelper
{
	public static function getTahunPelajaran()
	{
		$thisYear = 0;
		$tempYear = 0;
		$tahunPelajaran = 0;
		if (date('m') > 6) {
		 	$thisYear = date('Y');
		 	$tempYear = date('Y')+1;
		 	$tahunPelajaran =$thisYear.'/'.$tempYear;
		}else{
			$thisYear = date('Y');
		 	$tempYear = date('Y')-1;
		 	$tahunPelajaran =  $tempYear.'/'.$thisYear;
		}

		return $tahunPelajaran; 
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

        // dd(strpos($collection[3]->posisi_gigi , 'gd'));

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
}