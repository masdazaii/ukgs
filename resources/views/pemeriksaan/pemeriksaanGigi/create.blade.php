@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Pemeriksaan Gigi</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Pemeriksaan Gigi</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}
	
	<div class="card">
        <div class="card-header">
        	<h4><span class="font-weight-semibold">Hasil Pemeriksaan Gigi {{ $sekolah->sekolah_name }}</span></h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pemeriksa</th>
                            <th>OHIS</th>
                            <th>Rujukan</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

	<div class="card">
		<div class="card-header">
			<form id="siswaForm">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group row">
							<label class="col-form-label col-md-2" >Pilih kelas</label>
							<div class="col-md-10">
								<select id="pilihKelas" class="form-control" name="pilihKelas">
									<option>Silahkan pilih kelas yang akan diperiksa</option>
									@for($i=0; $i < count($kelas); $i++)
										<option value="{{ $kelas[$i]->kelas_id }}">{{ $kelas[$i]->kelas_name }}</option>
									@endfor
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group row">
							<label class="col-form-label col-md-2" >Pilih siswa</label>
							<div class="col-md-10">
								<select id="pilihSiswa" class="form-control" name="pilihSiswa" >
									<option>Silahkan pilih siswa</option>								
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form id="detailForm">
				<div class="row d-flex">
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Sekolah</label>
						<input id="sekolah" type="text" class="form-control col-sm-10" readonly value="">
					</div>
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Kelas</label>
						<input id="kelas" type="text" class="form-control col-sm-10" readonly value="">
					</div>
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Nama</label>
						<input id="nama" type="text" class="form-control col-sm-10" readonly value="">
					</div>
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Jenis kelamin</label>
						<input id="jenisKelamin" type="text" class="form-control col-sm-10" readonly value="">
					</div>
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Usia</label>
						<input id="usia" type="text" class="form-control col-sm-10" name="usia" readonly value="">
					</div>
					<div class="form-group row col-md-12">
						<label class="col-form-label col-sm-2">Alamat</label>
						<input id="alamat" type="text" class="form-control col-sm-10" readonly value="">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		{{-- Indeks Karies --}}
		<form id="pemeriksaanGigiForm" action="" method="POST" enctype="multipart/form-data" >
		@csrf
		{{ method_field('POST') }}
		<input type="hidden" name="jenisPemeriksaan" value="{{ $id }}">
		<div class="card-header">
			<div class="row d-flex">
				<div class="container-fluid">
					<h5 class="no-margin-bottom">Indeks Karies</h5>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<table class="table table-responsive text-center">
					<tr class="gigi_kosong">
						<td class="gigi_kosong">18</td>
						<td class="gigi_kosong">17</td>
						<td class="gigi_kosong">16</td>
						<td class="gigi_kosong">15</td>
						<td class="gigi_kosong">14</td>
						<td class="gigi_kosong">13</td>
						<td class="gigi_kosong">12</td>
						<td class="gigi_kosong">11</td>
						<td class="gigi_kosong">21</td>
						<td class="gigi_kosong">22</td>
						<td class="gigi_kosong">23</td>
						<td class="gigi_kosong">24</td>
						<td class="gigi_kosong">25</td>
						<td class="gigi_kosong">26</td>
						<td class="gigi_kosong">27</td>
						<td class="gigi_kosong">28</td>
					</tr>
					<tr class="gigi_border">
						@for($i=18;$i >= 11;$i--)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						@for($i=21;$i<=28;$i++)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
					</tr>
					<tr>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						@for($i=55;$i>=51;$i--)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						@for($i=61;$i<=65;$i++)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
					</tr>
					<tr>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong">55</td>
						<td class="gigi_kosong">54</td>
						<td class="gigi_kosong">53</td>
						<td class="gigi_kosong">52</td>
						<td class="gigi_kosong">51</td>
						<td class="gigi_kosong">61</td>
						<td class="gigi_kosong">62</td>
						<td class="gigi_kosong">63</td>
						<td class="gigi_kosong">64</td>
						<td class="gigi_kosong">65</td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_kosong">
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong">85</td>
						<td class="gigi_kosong">84</td>
						<td class="gigi_kosong">83</td>
						<td class="gigi_kosong">82</td>
						<td class="gigi_kosong">81</td>
						<td class="gigi_kosong">71</td>
						<td class="gigi_kosong">72</td>
						<td class="gigi_kosong">73</td>
						<td class="gigi_kosong">74</td>
						<td class="gigi_kosong">75</td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
					</tr>
					<tr>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						@for($i=85;$i>=81;$i--)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						@for($i=71;$i<=75;$i++)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_border">
						@for($i=38;$i>=31;$i--)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
						@for($i=41;$i<=48;$i++)
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</td>
						@endfor
					</tr>
					<tr class="gigi_kosong">
						<td class="gigi_kosong">38</td>
						<td class="gigi_kosong">37</td>
						<td class="gigi_kosong">36</td>
						<td class="gigi_kosong">35</td>
						<td class="gigi_kosong">34</td>
						<td class="gigi_kosong">33</td>
						<td class="gigi_kosong">32</td>
						<td class="gigi_kosong">31</td>
						<td class="gigi_kosong">41</td>
						<td class="gigi_kosong">42</td>
						<td class="gigi_kosong">43</td>
						<td class="gigi_kosong">44</td>
						<td class="gigi_kosong">45</td>
						<td class="gigi_kosong">46</td>
						<td class="gigi_kosong">47</td>
						<td class="gigi_kosong">48</td>
					</tr>
				</table>
				<div class="row mt-3">
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi sulung</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiSulung">
						<label class="col-sm-4 col-form-label mt-1">Skor def-t</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDefT">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1 text-right">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">d</label>
								<input class="form-control col-xs-10 text-center defD" name="defD">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">e</label>
								<input class="form-control col-xs-10 text-center defE" name="defE">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">f</label>
								<input class="form-control col-xs-10 text-center defF" name="defF">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">Exo Pers</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" value="0" name="exoPers" required>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" value="1" name="exoPers" required>
									-
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi permanen</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiPermanen">
						<label class="col-sm-4 col-form-label mt-1">Skor DMF-T</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDmfT">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">D</label>
								<input class="form-control col-xs-10 text-center dmfD" name="dmfD">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">M</label>
								<input class="form-control col-xs-10 text-center dmfM" name="dmfM">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">F</label>
								<input class="form-control col-xs-10 text-center dmfF" name="dmfF">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">FS</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input fsPlus" value="0" name="fs" required disabled>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input fsMinus" value="1" name="fs" required disabled>
									-
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row">
				<div class="container-fluid">
					<h5 class="no-margin-bottom">Indeks kebersihan mulut (OHI-S)</h5>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row mb-3">
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Debris</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-sm-4 debris_kalkulus" name="debris1" required>
								<input class="col-sm-4 debris_kalkulus" name="debris2" required>
								<input class="col-sm-4 debris_kalkulus" name="debris3" required>
							</tr>
							<tr>
								<input class="col-sm-4 debris_kalkulus" name="debris4" required>
								<input class="col-sm-4 debris_kalkulus" name="debris5" required>
								<input class="col-sm-4 debris_kalkulus" name="debris6" required>
							</tr>
						</table>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Kalkulus</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus1" required>
								<input class="col-md-4 debris_kalkulus" name="kalkulus2" required>
								<input class="col-md-4 debris_kalkulus" name="kalkulus3" required>
							</tr>
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus4" required>
								<input class="col-md-4 debris_kalkulus" name="kalkulus5" required>
								<input class="col-md-4 debris_kalkulus" name="kalkulus6" required>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group row col-md-6">
					<label class="col-sm-3 col-form-label">OHI-S (DI + CI)</label>
					<input type="text" class="form-control col-sm-9 ohis" readonly value="" name="ohiS">
				</div>
				<div class="form-group row col-md-6 ml-2">
					<div class="form-group pt-2">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_baik" name="ohisDetail" disabled >
								Baik (0-1,2)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_cukup" name="ohisDetail" disabled >
								Cukup (1,3-3)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_kurang" name="ohisDetail" disabled >
								Kurang (3-6)
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="card-header">
			<div class="row">
				<div class="container-fluid">
					<h5 class="no-margin-bottom">Kasus Gigi dan Mulut</h5>
				</div>
			</div>
		</div> --}}{{-- 
		<div class="card-body">
			<div class="container-fluid">
				<div class="row">
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" value="0" name="kasusGigiMulut" data-fouc  required>
								Sehat tidak ada kelainan
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" value="1" name="kasusGigiMulut" data-fouc required>
								Persistensi pada gigi
							</label>
							<input type="text" name="persistensi" class="form-control" disabled>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" value="2" name="kasusGigiMulut" data-fouc  required>
								Karies pada gigi
							</label>
							<input type="text" name="kariespadagigi" class="form-control" disabled>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" value="3" name="kasusGigiMulut" data-fouc required>
								Rampan karies
							</label>
						</div>
					</div>
				</div>
			</div>
		</div> --}}
		<div class="card-header">
			<div class="row d-flex">
				<div class="form-group row col-md-6">
					<div class="container-fluid">
						<h5 class="no-margin-bottom">Kesehatan Gusi</h5>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="0" name="kesehatanGusi" required>
							Baik
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="1" name="kesehatanGusi" required>
							Ringan
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="2" name="kesehatanGusi" required>
							Sedang
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="3" name="kesehatanGusi" required>
							Berat
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row d-flex">
				<div class="form-group row col-md-6">
					<div class="container-fluid">
						<h5 class="no-margin-bottom">Frekuensi menyikat gigi</h5>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="1" name="menyikatGigi" required>
							1
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="2" name="menyikatGigi" required>
							2
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="3" name="menyikatGigi" required>
							3
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row d-flex">
				<div class="form-group row col-md-6">
					<div class="container-fluid">
						<h5 class="no-margin-bottom">Rujukan ke dokter terdekat</h5>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="1" name="rujukan" required>
							+
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="0" name="rujukan" required>
							-
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row d-flex">
				<div class="form-group row col-md-6">
					<div class="container-fluid">
						<h5 class="no-margin-bottom">Deskripsi</h5>
					</div>
				</div>
				<div class="form-group row col-md-6">
	                <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Default textarea" readonly="readonly"></textarea>
	                <span class="form-text text-muted">Isikan deskripsi ketika siswa perlu dirujuk</span>
				</div>
	        </div>
		</div>
		<div class="card-footer text-right">
			<a type="button" class="btn btn-secondary" href="{{ URL::to('/pemeriksaanGigi') }}">Back</a>
	        <button id="pemeriksaanGigiSubmit" type="button" class="btn bg-primary">Submit form</button>
        </div>
    	</form>
	</div>

	<div id="modal_form_vertical_show" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pemeriksaan Gigi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                   <table width="100px" class="table table-striped table-bordered">
                   		<thead>
                   			<tr>
								<th class="text-center">NIS</th>
								<th width="25%" class="text-center">Nama Siswa</th>
								<th class="text-center">Usia (tahun)</th>
								<th class="text-center">Jenis Kelamin</th>
								<th class="text-center">Kesehatan Gusi</th>
								<th width="25%" class="text-center">Frekuensi Menyikat Gigi</th>
								<th colspan="2" class="text-center">OHI-S</th>
							</tr>
                   		</thead>
                   		<tbody>
                   			<tr>
                   				<td id="nis"></td>
                   				<td id="namaSiswa"></td>
                   				<td id="usiaSiswa"></td>
                   				<td id="jenisKelaminSiswa"></td>
                   				<td id="kesehatanGusi"></td>
                   				<td id="frekuensiMenyikatGigi"></td>
                   				<td id="ohis"></td>
                   				<td id="ohisStatus"></td>
                   			</tr>
                   		</tbody>
					<table>
					<table class="table table-xs table-striped table-bordered mt-4">
						<thead>
							<tr>
								<th colspan="6" class="text-center">Gigi Desidul</th>
								<th colspan="6" class="text-center">Gigi Permanen</th>
							</tr>
							<tr>
								<th>&#931 Gigi Desidul</th>
								<th>d</th>
								<th>e</th>
								<th>f</th>
								<th>def-t</th>
								<th>EXO-Pers</th>
								<th>&#931 Gigi Permanen</th>
								<th>d</th>
								<th>m</th>
								<th>f</th>
								<th>dmf-t</th>
								<th width="5%">FS</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                   				<td id="totalDef"></td>
                   				<td id="defD"></td>
                   				<td id="defE"></td>
                   				<td id="defF"></td>
                   				<td id="defT"></td>
                   				<td id="exoPers"></td>
                   				<td id="totalDmf"></td>
                   				<td id="dmfD"></td>
                   				<td id="dmfM"></td>
                   				<td id="dmfF"></td>
                   				<td id="dmfT"></td>
                   				<td id="fs"></td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/form_select2.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/form_checkboxes_radios.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
@endsection
@section('script')
	<script>
		const swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

		$(document).ready(function(){
			$("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('detailPemeriksaanGigiAjax/'.$id.'/'.$sekolah->sekolah_id) }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                	{data: 'siswa_id', name:'siswa_id'},
                    {data: 'pemeriksa_id',name: 'pemeriksa_id'},
                    {data: 'ohis', name: 'ohis'},
                    {data: 'rujukan', name: 'rujukan'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

			$("#pilihKelas").on('change',function(){
				const id = $(this).val();
				const jenisPemeriksaan = {{ $id }};
				$('#pilihSiswa option').remove();
				$.ajax({
					url:'{{ url('siswaByKelasAjax') }}',
					method: 'GET',
					data : {
						pemeriksaan : jenisPemeriksaan,
						id:id
					},
					success : function(response){
						if(response.length > 0){
							$('#pilihSiswa').append('<option>Silahkan pilih siswa</option>')
							for (let i = 0; i < response.length; i++) {
								$('#pilihSiswa').append('<option value='+response[i].siswa.siswa_id+'>'+response[i].siswa.nama+'</option>')
							}
						}else{
							$('#pilihSiswa').append('<option>Semua siswa di kelas ini sudah diperiksa</option>')
						}
					}
				})
			})

			$("#pilihSiswa").on('change',function(){
				const id = $(this).val();
				let alamat = '{{ route('storePemeriksaanGigi',':id') }}'
				alamat = alamat.replace(':id',id);
				$('#pemeriksaanGigiForm').attr('action',alamat);
				$.ajax({
					url: '{{ url('detailSiswa') }}',
					method: 'GET',
					data : {
						id:id					},
					success : function(data){
						$("#sekolah").val(data.kelas_mapping[0].kelas.sekolah.sekolah_name);
						$("#kelas").val(data.kelas_mapping[0].kelas.kelas_name);
						$("#nama").val(data.nama);
						$("#jenisKelamin").val(data.jenis_kelamin);
						$("#alamat").val(data.alamat);
						$('#usia').val(data.usia);
					}

				})
			});

			//count fs plus or minus
			let fs = [];

			let name = [];
			let value = []; 
			$(".gigi_dewasa").on('change',function(){
				const attrName = $(this).attr('name');
				const attrValue = $(this).val();
				if(name.includes(attrName) == true)
				{
					const index = name.indexOf(attrName);
					if(attrValue == 0 || attrValue == ''){
						name.splice(index,1);
						value.splice(index,1);
					}else{
						value[index] = attrValue;	
					}
				}else{
					name.push(attrName);
					value.push(attrValue);
				}

				const D = value.filter(function(angka){
					return angka == 2;
				}).length;
				$(".dmfD").val(D);

				const M = value.filter(function(angka){
					return angka == 3;
				}).length;
				$(".dmfM").val(M);

				const F = value.filter(function(angka){
					return angka == 4;
				}).length;
				$(".dmfF").val(F);

				let dmf = D+M+F;
				fs["dmf"] = dmf;

				if (fs["dmf"] > 1 && fs["def"] > 4){
					$('.fsPlus').prop('checked',true);
				} else {
					$('.fsMinus').prop('checked',true);
				}

				const zero = value.filter(function(angka){
					return angka == "";
				}).length;
				$('input[name="jumlahGigiPermanen"]').val(value.length - zero);
				$('input[name="jumlahDmfT"]').val(dmf);
			});

			let nameGigiSulung = [];
			let valueGigiSulung = [];
			$(".gigi_sulung").on('change',function(){
				const attrName = $(this).attr('name');
				const attrValue = $(this).val();
				if(nameGigiSulung.includes(attrName) == true)
				{
					const index = nameGigiSulung.indexOf(attrName);
					if(attrValue == 0 || attrValue == ''){
						nameGigiSulung.splice(index,1);
						valueGigiSulung.splice(index,1);
					}else{
						valueGigiSulung[index] = attrValue;	
					}
				}else{
					nameGigiSulung.push(attrName);
					valueGigiSulung.push(attrValue);
				}

				const D = valueGigiSulung.filter(function(angka){
					return angka == 2;
				}).length;
				$(".defD").val(D);

				const E = valueGigiSulung.filter(function(angka){
					return angka == 3;
				}).length;
				$(".defE").val(E);

				const F = valueGigiSulung.filter(function(angka){
					return angka == 4;
				}).length;
				$(".defF").val(F);

				let def = D+E+F;
				fs["def"] = def;

				if (fs["dmf"] > 1 && fs["def"] > 4){
					$('.fsPlus').prop('checked',true);
				} else {
					$('.fsMinus').prop('checked',true);
				}

				const zero = valueGigiSulung.filter(function(angka){
					return angka == "";
				}).length;

				$('input[name="jumlahGigiSulung"]').val(valueGigiSulung.length - zero);
				$('input[name="jumlahDefT"]').val(def);
			})

			let indeksName = [];
			let indeksValue =[];

			$('.debris_kalkulus').keyup(function(){
				const name = $(this).attr('name');
				const value = $(this).val();
				let jumlah = 0;
				
				if(indeksName.includes(name) == true){
					const index = indeksName.indexOf(name);
					indeksValue[index] = value;
				}else{
					indeksName.push(name);
					indeksValue.push(value);
				}

				for(let i = 0; i < indeksValue.length ; i++ )
				{
					if(indeksValue[i] == "")
					{
						jumlah += 0;
					}else{
						jumlah += parseInt(indeksValue[i]);
					}
				}

				const zero = indeksValue.filter(function(angka){
					return angka == "";
				}).length;
				let ohis = (jumlah/(indeksValue.length - zero)).toFixed(1);

				$('.ohis').val(ohis);

				if(ohis >= 0 && ohis <=1.2)
				{
					$('.radio_baik').prop('checked',true);
				}else if( ohis >= 1.3 && ohis <=3)
				{
					$('.radio_cukup').prop('checked',true);
				}else{
					$('.radio_kurang').prop('checked',true);
				}
			});

			$('input[name="rujukan"]').on('change',function(){
                const val = $(this).val();
                if (val ==0) {
                    const deskripsi = document.getElementById('deskripsi');
                    deskripsi.value = deskripsi.defaultValue;
                    $('#deskripsi').prop('readonly',true);
                }else{
                    $('#deskripsi').prop('readonly',false);
                }
            })

			$('#pemeriksaanGigiSubmit').on('click',function(){
				const siswaForm = $('#siswaForm');
                siswaForm.validate({
                    errorClass: 'validation-invalid-label',
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    }
                });
                const createForm = $('#pemeriksaanGigiForm');
                createForm.validate({
                    errorClass: 'validation-invalid-label',
                    errorPlacement: function(error,element){
                    	error.appendTo(element.parents('.form-group'));
                    },
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    }
                });

				if(createForm.valid()&&siswaForm.valid()){
					const jenisPemeriksaan = $('input[name="jenisPemeriksaan"]').val();
					const exoPers = $('input[name="exoPers"]').val();
					const fs = $('input[name="fs"]').val();
					const debris1 = $('input[name="debris1"]').val();
					const debris2 = $('input[name="debris2"]').val();
					const debris3 = $('input[name="debris3"]').val();
					const debris4 = $('input[name="debris4"]').val();
					const debris5 = $('input[name="debris5"]').val();
					const debris6 = $('input[name="debris6"]').val();
					const kalkulus1 = $('input[name="kalkulus1"]').val();
					const kalkulus2 = $('input[name="kalkulus2"]').val();
					const kalkulus3 = $('input[name="kalkulus3"]').val();
					const kalkulus4 = $('input[name="kalkulus4"]').val();
					const kalkulus5 = $('input[name="kalkulus5"]').val();
					const kalkulus6 = $('input[name="kalkulus6"]').val();
					const ohiS = $('input[name="ohiS"]').val();
					const kesehatanGusi = $('input[name="kesehatanGusi"]:checked').val();
					const menyikatGigi = $('input[name="menyikatGigi"]:checked').val();
					const rujukan = $('input[name="rujukan"]:checked').val();
					const alamat = $('#pemeriksaanGigiForm').attr('action');
					const deskripsi = $('#deskripsi').val();
					
					//convert array to json
					let gigiJson = [];
					for(var i = 0; i  < name.length;i++)
					{
						let gigiDewasa = {};
						gigiDewasa['posisiGigi'] = name[i];
						gigiDewasa['keadaanGigi'] = value[i];
						gigiJson.push(gigiDewasa);
					}
					for(var i = 0; i  < nameGigiSulung.length;i++)
					{
						let gigiSulung = {};
						gigiSulung['posisiGigi'] = nameGigiSulung[i];
						gigiSulung['keadaanGigi'] = valueGigiSulung[i];
						gigiJson.push(gigiSulung);

					}
					//start ajax
					$.ajax({
						url : alamat,
						method : 'POST',
						data : {
							jenisPemeriksaan : jenisPemeriksaan,
							exoPers : exoPers,
							fs : fs,
							debris1 : debris1,
							debris2 : debris2,
							debris3 : debris3,
							debris4 : debris4,
							debris5 : debris5,
							debris6 : debris6,
							kalkulus1 : kalkulus1,
							kalkulus2 : kalkulus2,
							kalkulus3 : kalkulus3,
							kalkulus4 : kalkulus4,
							kalkulus5 : kalkulus5,
							kalkulus6 : kalkulus6,
							ohiS : ohiS,
							kesehatanGusi : kesehatanGusi,
							menyikatGigi : menyikatGigi,
							rujukan : rujukan,
							deskripsi: deskripsi,
							gigiJson: gigiJson,
							_token: '{{ csrf_token() }}'
						},
						success : function(response){
							siswaForm[0].reset();
                            createForm[0].reset();
                            $("#detailForm")[0].reset();
                            $("#table").DataTable().ajax.reload();
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
                            swalInit({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
					})
				}
			})
		});

		$(document).on('click','.delete',function(event){
			event.preventDefault()
			const pemeriksaanId = $(this).data("idpemeriksaangigi");
			let alamat = '{{ route('pemeriksaanGigi.destroy',':id') }}';
			alamat = alamat.replace(':id',pemeriksaanId);
			
			swalInit({
				title: 'Apakah anda yakin ingin menghapus data ini ?',
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!'
			}).then(function(result){
				if(result.value){
					$.ajax({
						url : alamat,
						type: 'POST',
			            data: {
			                _token:'{{ csrf_token() }}',
			                _method: 'Delete'
			            },
			            success : function(response){
		                    $("#table").DataTable().ajax.reload();
		                    swalInit({
		                        type: 'success',
		                        title : response,
		                    });
		                },
		                error:function(xhr,status,error){
		                    swalInit({
		                        type: 'error',
		                        title : xhr.responseText,
		                    });
		                }
					})
				}
			})
		})

		$(document).on('click','.detail',function(){
			const pemeriksaanId = $(this).data("idpemeriksaangigi");
			let alamat = '{{ route('pemeriksaanGigi.show',':id') }}';
			alamat = alamat.replace(':id',pemeriksaanId);
			$.ajax({
				url : alamat,
				type: 'GET',
	            data: {
	                _token:'{{ csrf_token() }}',
	            },
	            success : function(response){
	            	const nama = document.getElementById('namaSiswa').innerText = response.siswa.nama;
	            	const nis = document.getElementById('nis').innerText = response.siswa.nis;
	            	const usia = document.getElementById('usiaSiswa').innerText = response.siswa.usia;
	            	const jenisKelamin = document.getElementById('jenisKelaminSiswa').innerText = response.siswa.jenis_kelamin;
	            	const kesehatanGusi = document.getElementById('kesehatanGusi').innerText = response.detail_pemeriksaan_gigi.kesehatan_gusi;
	            	const frekuensiMenyikatGigi = document.getElementById('frekuensiMenyikatGigi').innerText = response.detail_pemeriksaan_gigi.frekuensi_menyikat_gigi;
	            	const ohis = document.getElementById('ohis').innerText = response.detail_pemeriksaan_gigi.ohis;
	            	const ohisStatus = document.getElementById('ohisStatus');
	            	if (response.detail_pemeriksaan_gigi.ohis >= 0 && response.detail_pemeriksaan_gigi.ohis <= 1.2) {
	            		ohisStatus.innerText = "Normal";
	            	}else if(response.detail_pemeriksaan_gigi.ohis > 1.2 && response.detail_pemeriksaan_gigi.ohis <= 3){
	            		ohisStatus.innerText = "Cukup";
	            	}else if(response.detail_pemeriksaan_gigi.ohis > 3 && response.detail_pemeriksaan_gigi.ohis <= 6){
	            		ohisStatus.innerText = "Kurang";
	            	}
	            	const totalDef = document.getElementById('totalDef').innerText = response.detail_pemeriksaan_gigi.indekkaries.jumlahDef;
	            	const defD = document.getElementById('defD').innerText = response.detail_pemeriksaan_gigi.indekkaries.defD;
	            	const defE = document.getElementById('defE').innerText = response.detail_pemeriksaan_gigi.indekkaries.defE;
	            	const defF = document.getElementById('defF').innerText = response.detail_pemeriksaan_gigi.indekkaries.defF;
	            	const defT = document.getElementById('defT').innerText = response.detail_pemeriksaan_gigi.indekkaries.skorDefT;
	            	const exoPers = document.getElementById('exoPers');
	            	if(response.detail_pemeriksaan_gigi.exo_pers == 1){
	            		exoPers.innerText = "+";
	            	}else{
	            		exoPers.innerText = "-";
	            	}
	            	const totalDmf = document.getElementById('totalDmf').innerText = response.detail_pemeriksaan_gigi.indekkaries.jumlahDmf;
	            	const dmfD = document.getElementById('dmfD').innerText = response.detail_pemeriksaan_gigi.indekkaries.dmfD;
	            	const dmfM = document.getElementById('dmfM').innerText = response.detail_pemeriksaan_gigi.indekkaries.dmfM;
	            	const dmfF = document.getElementById('dmfF').innerText = response.detail_pemeriksaan_gigi.indekkaries.dmfF;
	            	const dmfT = document.getElementById('dmfT').innerText = response.detail_pemeriksaan_gigi.indekkaries.skorDmfT;
	            	const fs = document.getElementById('fs');
	            	if(response.detail_pemeriksaan_gigi.fs == 1){
	            		fs.innerText = "+";
	            	}else{
	            		fs.innerText = "-";
	            	}
                    $('#modal_form_vertical_show').modal('show');
                },
                error:function(xhr,status,error){
                    Swal.fire({
                        type: 'error',
                        title : xhr.responseText,
                    });
                }
			})
		})
	</script>
@endsection