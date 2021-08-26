<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use App\Helpers\FunctionHelper;
use App\Exports\PemeriksaanExportPerSheet;
use App\User;
use App\Sekolah;
use App\Siswa;
use App\Kelas;
use App\Kelurahan;
use App\Pemeriksaan;
use App\DetailPemeriksaanPtm;
use App\DetailPemeriksaanGigi;
use App\DetailPemeriksaanSosial;
use App\DetailPemeriksaanImt;
use App\TahunAjaran;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$top = [
    		'sekolah' => Sekolah::count(),
	    	'siswa' => Siswa::whereHas('kelasMapping')
	    				->count(),
	    	'kelurahan' => Kelurahan::count(),
	    	'pemeriksa' => User::count(),
    	];

        $tahunAjaran = TahunAjaran::select('tahun_ajaran_id','tahun_ajaran')
                        ->get();

    	return view('dashboard.index',compact('top','tahunAjaran'));
    }

    public function laporan($id,$tahunAjaran)
    {
        $tempTA = TahunAjaran::where('tahun_ajaran_id',$tahunAjaran)
                ->select('tahun_ajaran_id','tahun_ajaran')
                ->first();

        $TA = explode('/',$tempTA->tahun_ajaran);

    	$sekolah = Sekolah::where('sekolah_id', $id)
	    		->select('sekolah_id','sekolah_name')
	    		->first();

        $kelas = Kelas::where('sekolah_id',$id)
                ->with(['kelasMapping' => function($query)use($tahunAjaran){
                    $query->where('tahun_pelajaran',$tahunAjaran)
                    ->with(['siswa' => function($query){
                        $query->withTrashed();
                        $query->with(['pemeriksaan' => function($query){
                            $query->whereIn('jenis_pemeriksaan',[1,2,5]);
                            $query->select('pemeriksaan_id','siswa_id','jenis_pemeriksaan','rujukan');
                            $query->orderBy('jenis_pemeriksaan','ASC');
                        }]);
                        $query->select('siswa_id','nama','jenis_kelamin','usia');
                    }])->withTrashed();
                }])
    			->select('sekolah_id','kelas_id','kelas_name')
    			->orderBy('kelas_name','ASC')
	    		->get();

	    for ($i=0; $i < count($kelas) ; $i++) {
         	for ($j=0; $j < count($kelas[$i]->kelasMapping) ; $j++) {
     			$deskripsi = Self::detailPemeriksaan($kelas[$i]->kelasMapping[$j]->siswa->pemeriksaan);
	 			unset($kelas[$i]->kelasMapping[$j]->siswa->pemeriksaan);
	 			$kelas[$i]->kelasMapping[$j]->siswa->deskripsi_pemeriksaan = $deskripsi;
         	}
        }

	    return Excel::download(new PemeriksaanExportPerSheet($kelas),'Laporan Pemeriksann '.$sekolah->sekolah_name.' tahun ajaran '.$TA[0].'-'.$TA[1].'.xlsx');
    }

    public static function detailPemeriksaan($collection)
    {
    	$data = [];
    	if (count($collection) >= 3) {
    		foreach ($collection as $key) {
	    		if ($key->jenis_pemeriksaan == 1) {
		    		$deskripsi = DetailPemeriksaanGigi::where('pemeriksaan_gigi_id',$key->pemeriksaan_id)
		    					->select('detail_pemeriksaan_gigi_id','pemeriksaan_gigi_id','exo_pers','fs','ohis','kesehatan_gusi','frekuensi_menyikat_gigi')
		    					->with(['indekKaries' => function($query){
		    						$query->select('detail_pemeriksaan_gigi_id','posisi_gigi','keadaan_gigi');
		    					}])
		    					->first();
		    		$def = 0;
		    		$dmf = 0;
		    		$defD = 0;
		    		$defE = 0;
		    		$defF = 0;
		    		$dmfF = 0;
		    		$dmfM = 0;
		    		$dmfD = 0;

		    		for ($i=0; $i < count($deskripsi->indekKaries); $i++) {
		    			if (strpos($deskripsi->indekKaries[$i]->posisi_gigi , 'gd') !== true) {
		    				$dmf++;
		    				if ($deskripsi->indekKaries[$i]->keadaan_gigi == 2) {
		    					$dmfD++;
		    				}elseif ($deskripsi->indekKaries[$i]->keadaan_gigi == 3) {
		    					$dmfM++;
		    				}else{
		    					$dmfF++;
		    				}
		    			}else{
		    				$def++;
		    				if ($deskripsi->indekKaries[$i]->keadaan_gigi == 2) {
		    					$defD++;
		    				}elseif ($deskripsi->indekKaries[$i]->keadaan_gigi == 3) {
		    					$defE++;
		    				}else{
		    					$defF++;
		    				}
		    			}
		    		}

		    		unset($deskripsi->indekKaries);

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
		    			'dmfF' => $dmfF,
		    			'ohis' => $deskripsi->ohis,
		    			'fs' => $deskripsi->fs,
		    			'exoPers' => $deskripsi->exo_pers,
		    			'kesehatanGusi' =>$deskripsi->kesehatan_gusi,
		    			'frekuensiMenyikatGigi' => $deskripsi->frekuensi_menyikat_gigi
		    		];

		    		$obj = (Object)$arr;
		    		$data['pemeriksaan_gigi'] = $obj;
		    	}else if($key->jenis_pemeriksaan == 2){
		    		$deskripsi = DetailPemeriksaanImt::where('pemeriksaan_imt_id',$key->pemeriksaan_id)
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

		    		$data['pemeriksaan_imt'] = $deskripsi;
		    	}else if($key->jenis_pemeriksaan == 5){
		    		$deskripsi = Pemeriksaan::where('pemeriksaan_id',$key->pemeriksaan_id)
		    					->select('pemeriksaan_id','siswa_id','jenis_pemeriksaan','rujukan')
		    					->first();
		    		$data['pemeriksaan_bw'] =$deskripsi;
		    	}
	    	}
    	}
    	return $data;
    }

    public function pemeriksaanChart($tahunPelajaran)
    {
    	$pemeriksaan = Pemeriksaan::select('siswa_id','created_at','rujukan')
    					->whereHas('siswa',function($query) use ($tahunPelajaran){
    						$query->whereHas('kelasMapping',function($query) use ($tahunPelajaran){
    							$query->where('tahun_pelajaran',$tahunPelajaran);
    						});
    					})
    					->get()
    					->groupBy(function($date){
    						return Carbon::parse($date->created_at)->format('m');
    					});
    	$arr = [
    		'Pemeriksaan' => [],
    		'Rujukan' => []
    	];

    	for ($i=1; $i <=12 ; $i++) {
    		$index = $i;
    		if ($i < 10) {
    		 	$index = '0'.$i;
    		}
    		if (isset($pemeriksaan[$index])) {
    			$arr['Pemeriksaan'][$i-1] = $pemeriksaan[$index]->count();
	    		$arr['Rujukan'][$i-1] = $pemeriksaan[$index]->where('rujukan',1)->count();
    		}else{
    			$arr['Pemeriksaan'][$i-1] = 0;
    			$arr['Rujukan'][$i-1] = 0;
    		}
    	}

    	return $arr;
    }

    public function ohisChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [];
    	foreach ($kelurahan as $index) {
    		$kelurahanName = $index->kelurahan_id;
    		$pemeriksaan = DetailPemeriksaanGigi::select('ohis')
    						->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanName){
    							$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanName){
				                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanName){
				                    	$query->where('tahun_pelajaran',$tahunPelajaran);
				                        $query->whereHas('kelas', function($query) use ($kelurahanName){
				                            $query->whereHas('sekolah',function($query) use ($kelurahanName){
				                            	$query->where('kelurahan',$kelurahanName);
				                            });
				                        });
				                    });
				                });
    						})
    						->avg('ohis');
    		if($pemeriksaan == null){
    			$pemeriksaan = 0;
    		}else{
    			$pemeriksaan = number_format(($pemeriksaan*23),2);
    		}
    		$result[$index->kelurahan_name] = [$pemeriksaan];
    	}
    	return $result;
    }

    public function fsChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [];
    	foreach ($kelurahan as $index) {
    		$kelurahanName = $index->kelurahan_id;
    		$pemeriksaan = DetailPemeriksaanGigi::where('fs',1)
    						->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanName){
    							$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanName){
				                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanName){
				                    	$query->where('tahun_pelajaran',$tahunPelajaran);
				                        $query->whereHas('kelas', function($query) use ($kelurahanName){
				                        	$query->where('kelas_name','LIKE','%'.'1')
				                        	->orWhere('kelas_name','LIKE','%'.'2');
				                            $query->whereHas('sekolah',function($query) use ($kelurahanName){
				                            	$query->where('sekolah_type',"SD");
				                            	$query->where('kelurahan',$kelurahanName);
				                            });
				                        });
				                    });
				                });
    						})
    						->count();

    		$result[$index->kelurahan_name] = $pemeriksaan;
    	}

    	return $result;
    }

    public function butaWarnaChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [];
    	foreach($kelurahan as $index)
    	{
    		$kelurahanId = $index->kelurahan_id;
    		$butaWarna = Pemeriksaan::where('jenis_pemeriksaan',5)
    					->whereHas('detailRujukan')
    					->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanId){
		                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanId){
		                    	$query->where('tahun_pelajaran',$tahunPelajaran);
		                        $query->whereHas('kelas', function($query) use ($kelurahanId){
		                            $query->whereHas('sekolah',function($query) use ($kelurahanId){
		                            	$query->where('kelurahan',$kelurahanId);
		                            });
		                        });
		                    });
		                })
		                ->count();
		    $result[$index->kelurahan_name] = $butaWarna;
    	}
    	return $result;
    }

    public function imtChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [
    		"x" => [],
    		"sangatKurus" => [],
            "kurus" => [],
            "normal" => [],
            "gemuk" => [],
            "sangatGemuk" => []
    	];

    	foreach($kelurahan as $index)
    	{
    		$kelurahanId = $index->kelurahan_id;
    		$imt = DetailPemeriksaanImt::select('berat_badan','tinggi_badan')
					->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanId){
						$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanId){
		                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanId){
		                    	$query->where('tahun_pelajaran',$tahunPelajaran);
		                        $query->whereHas('kelas', function($query) use ($kelurahanId){
		                            $query->whereHas('sekolah',function($query) use ($kelurahanId){
		                            	$query->where('kelurahan',$kelurahanId);
		                            });
		                        });
		                    });
		                });
					})
	                ->get();
	        
	        $temp = FunctionHelper::cekStatusImt($imt);
	        array_push($result["sangatKurus"], $temp["sangatKurus"]);
	        array_push($result["kurus"], $temp["kurus"]);
	        array_push($result["normal"], $temp["normal"]);
	        array_push($result["gemuk"], $temp["gemuk"]);
	        array_push($result["sangatGemuk"], $temp["sangatGemuk"]);
	    	array_push($result["x"],$index->kelurahan_name);
    	}
    	return $result;
    }

    public function sosialChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [
    		"x" => [],
    		"Merokok" => [],
    		"Sex Bebas" => [],
            "Minum Alkohol" => [],
            "Konsumsi Narkoba" => []
    	];

    	foreach($kelurahan as $index)
    	{
    		$kelurahanId = $index->kelurahan_id;
    		$sosial = DetailPemeriksaanSosial::select('merokok','free_sex','minum_alkohol','narkoba')
					->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanId){
						$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanId){
		                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanId){
		                    	$query->where('tahun_pelajaran',$tahunPelajaran);
		                        $query->whereHas('kelas', function($query) use ($kelurahanId){
		                            $query->whereHas('sekolah',function($query) use ($kelurahanId){
		                            	$query->where('kelurahan',$kelurahanId);
		                            });
		                        });
		                    });
		                });
					})
	                ->get();

	        $temp = FunctionHelper::sosialFilter($sosial);
	        array_push($result["Merokok"], $temp["merokok"]);
	        array_push($result["Sex Bebas"], $temp["sexBebas"]);
	        array_push($result["Minum Alkohol"], $temp["minumAlkohol"]);
	        array_push($result["Konsumsi Narkoba"], $temp["narkoba"]);
	    	array_push($result["x"],$index->kelurahan_name);
    	}

    	return $result;
    }

    public function kesehatanGusiChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();
    	$result = [
    		"x" => [],
    		"Baik" => [],
    		"Cukup" => [],
            "Kurang" => [],
            "Jelek" => []
    	];
    	foreach($kelurahan as $index)
    	{
    		$kelurahanId = $index->kelurahan_id;
    		$kesehatanGusi = DetailPemeriksaanGigi::select('kesehatan_gusi')
    					->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanId){
						$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanId){
		                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanId){
		                    	$query->where('tahun_pelajaran',$tahunPelajaran);
		                        $query->whereHas('kelas', function($query) use ($kelurahanId){
		                            $query->whereHas('sekolah',function($query) use ($kelurahanId){
		                            	$query->where('kelurahan',$kelurahanId);
		                            });
		                        });
		                    });
		                });
					})
		            ->get();

		    $temp = FunctionHelper::kesehatanGusiStatus($kesehatanGusi);
	        array_push($result["Baik"], $temp["baik"]);
	        array_push($result["Cukup"], $temp["cukup"]);
	        array_push($result["Kurang"], $temp["kurang"]);
	        array_push($result["Jelek"], $temp["jelek"]);
	    	array_push($result["x"],$index->kelurahan_name);
    	}
    	return $result;
    }

    public function tekananDarahChart($tahunPelajaran)
    {
    	$kelurahan = Kelurahan::select('kelurahan_id','kelurahan_name')
    				->get();

    	$result = [];

    	foreach ($kelurahan as $index) {
    		$kelurahanId = $index->kelurahan_id;
	    	$tekananDarah = DetailPemeriksaanPtm::select('tekanan_sistolik','tekanan_diastolik')
						->whereHas('pemeriksaan',function($query) use ($tahunPelajaran,$kelurahanId){
							$query->whereHas('siswa', function($query) use ($tahunPelajaran,$kelurahanId){
			                    $query->whereHas('kelasMapping', function($query) use ($tahunPelajaran,$kelurahanId){
			                    	$query->where('tahun_pelajaran',$tahunPelajaran);
			                        $query->whereHas('kelas', function($query) use ($kelurahanId){
			                            $query->whereHas('sekolah',function($query) use ($kelurahanId){
			                            	$query->where('kelurahan',$kelurahanId);
			                            });
			                        });
			                    });
			                });
						})
		                ->get();

		    $sistolik = number_format($tekananDarah->avg('tekanan_sistolik'),0);
		    $diastoik = number_format($tekananDarah->avg('tekanan_diastolik'),0);

		    array_push($result, ["kelurahan" => $index->kelurahan_name,"rerata" => $sistolik.'/'.$diastoik]);
    	}

    	return $result;
    }
}
