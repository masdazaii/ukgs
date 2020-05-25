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
		      		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
		{{-- Indeks Karies --}}
		<form id="pemeriksaanGigiForm" action="" method="POST" enctype="multipart/form-data" >
		@csrf
		{{ method_field('PUT') }}
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
							@php
								$table = 'gda'.$i;
								$val = 0;
								if(in_array($table,$posisiGd)){
									$index = array_search($table, $posisiGd);
									$val = $keadaanGd[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=21;$i<=28;$i++)
							@php
								$table = 'gda'.$i;
								$val = 0;
								if(in_array($table,$posisiGd)){
									$index = array_search($table, $posisiGd);
									$val = $keadaanGd[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
					</tr>
					<tr>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						@for($i=55;$i>=51;$i--)
							@php
								$table = 'gsa'.$i;
								$val = 0;
								if(in_array($table,$posisiGs)){
									$index = array_search($table, $posisiGs);
									$val = $keadaanGs[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=61;$i<=65;$i++)
							@php
								$table = 'gsa'.$i;
								$val = 0;
								if(in_array($table,$posisiGs)){
									$index = array_search($table, $posisiGs);
									$val = $keadaanGs[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
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
							@php
								$table = 'gsb'.$i;$val = 0;
								if(in_array($table,$posisiGs)){
									$index = array_search($table, $posisiGs);
									$val = $keadaanGs[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=71;$i<=75;$i++)
							@php
								$table = 'gsb'.$i;$val = 0;
								if(in_array($table,$posisiGs)){
									$index = array_search($table, $posisiGs);
									$val = $keadaanGs[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_border">
						@for($i=38;$i>=31;$i--)
							@php
								$table = 'gdb'.$i;
								$val = 0;
								if(in_array($table,$posisiGd)){
									$index = array_search($table, $posisiGd);
									$val = $keadaanGd[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=41;$i<=48;$i++)
							@php
								$table = 'gdb'.$i;
								$val = 0;
								if(in_array($table,$posisiGd)){
									$index = array_search($table, $posisiGd);
									$val = $keadaanGd[$index];
								}
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($val == 1) selected @endif>
										1
									</option>
									<option value="2" @if($val == 2) selected @endif>
										2
									</option>
									<option value="3" @if($val == 3) selected @endif>
										3
									</option>
									<option value="4" @if($val == 4) selected @endif>
										4
									</option>
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
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiSulung" value="{{ count($keadaanGs) }}">
						<label class="col-sm-4 col-form-label mt-1">Skor def-t</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDefT" value="{{ $defD+$defE+$defF }}">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1 text-right">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">d</label>
								<input class="form-control col-xs-10 text-center defD" name="defD" value="{{ $defD }}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">e</label>
								<input class="form-control col-xs-10 text-center defE" name="defE" value="{{ $defE}}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">f</label>
								<input class="form-control col-xs-10 text-center defF" name="defF" value="{{ $defF }}">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">Exo Pers</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" value="0" @if($pemeriksaanGigi->detailPemeriksaanGigi->exo_pers == 0) checked @endif name="exoPers" required>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" value="1" @if($pemeriksaanGigi->detailPemeriksaanGigi->exo_pers == 1) checked @endif name="exoPers" required>
									-
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi permanen</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiPermanen" value="{{ count($keadaanGd) }}">
						<label class="col-sm-4 col-form-label mt-1">Skor DMF-T</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDmfT" value="{{ $dmfD+$dmfM+$dmfF }}">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">D</label>
								<input class="form-control col-xs-10 text-center dmfD" name="dmfD" value="{{ $dmfD }}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">M</label>
								<input class="form-control col-xs-10 text-center dmfM" name="dmfM" value="{{ $dmfM }}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">F</label>
								<input class="form-control col-xs-10 text-center dmfF" name="dmfF" value="{{ $dmfF }}">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">FS</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input fsPlus" value="1" @if($pemeriksaanGigi->detailPemeriksaanGigi->fs == 1) checked @endif name="fs" required disabled>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input fsMinus" value="0" @if($pemeriksaanGigi->detailPemeriksaanGigi->fs == 0) checked @endif name="fs" required disabled>
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
								<input class="col-sm-4 debris_kalkulus" name="debris1" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_1}}">
								<input class="col-sm-4 debris_kalkulus" name="debris2" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_2}}">
								<input class="col-sm-4 debris_kalkulus" name="debris3" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_3}}">
							</tr>
							<tr>
								<input class="col-sm-4 debris_kalkulus" name="debris4" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_4}}">
								<input class="col-sm-4 debris_kalkulus" name="debris5" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_5}}">
								<input class="col-sm-4 debris_kalkulus" name="debris6" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->debris_6}}">
							</tr>
						</table>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Kalkulus</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus1" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_1}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus2" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_2}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus3" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_3}}">
							</tr>
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus4" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_4}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus5" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_5}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus6" required value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->kalkulus_6}}">
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group row col-md-6">
					<label class="col-sm-3 col-form-label">OHI-S (DI + CI)</label>
					<input type="text" class="form-control col-sm-9 ohis" readonly value="{{ $pemeriksaanGigi->detailPemeriksaanGigi->ohis}}" name="ohiS" required>
				</div>
				<div class="form-group row col-md-6 ml-2">
					<div class="form-group pt-2">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_baik" name="ohisDetail" @if($pemeriksaanGigi->detailPemeriksaanGigi->ohis > 0 && $pemeriksaanGigi->detailPemeriksaanGigi->ohis <= 1.2) checked @endif disabled >
								Baik (0-1,2)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_cukup" name="ohisDetail" @if($pemeriksaanGigi->detailPemeriksaanGigi->ohis > 1.2 && $pemeriksaanGigi->detailPemeriksaanGigi->ohis <= 3) checked @endif disabled >
								Cukup (1,3-3)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input radio_kurang" name="ohisDetail" @if($pemeriksaanGigi->detailPemeriksaanGigi->ohis > 3 && $pemeriksaanGigi->detailPemeriksaanGigi->ohis <= 6) checked @endif disabled >
								Kurang (3-6)
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
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
							<input type="radio" class="form-check-input" value="0" name="kesehatanGusi" required @if($pemeriksaanGigi->detailPemeriksaanGigi->kesehatan_gusi == 0) checked @endif>
							Baik
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="1" name="kesehatanGusi" required @if($pemeriksaanGigi->detailPemeriksaanGigi->kesehatan_gusi == 1) checked @endif>
							Ringan
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="2" name="kesehatanGusi" required @if($pemeriksaanGigi->detailPemeriksaanGigi->kesehatan_gusi == 2) checked @endif>
							Sedang
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="3" name="kesehatanGusi" required @if($pemeriksaanGigi->detailPemeriksaanGigi->kesehatan_gusi == 3) checked @endif>
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
							<input type="radio" class="form-check-input" value="1" name="menyikatGigi" @if($pemeriksaanGigi->detailPemeriksaanGigi->frekuensi_menyikat_gigi == 1) checked @endif required>
							1
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="2" name="menyikatGigi" @if($pemeriksaanGigi->detailPemeriksaanGigi->frekuensi_menyikat_gigi == 2) checked @endif required>
							2
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="3" name="menyikatGigi" @if($pemeriksaanGigi->detailPemeriksaanGigi->frekuensi_menyikat_gigi == 3) checked @endif required>
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
							<input type="radio" class="form-check-input" value="1" name="rujukan" @if($pemeriksaanGigi->rujukan == 1) checked @endif required>
							+
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="0" name="rujukan" @if($pemeriksaanGigi->rujukan == 0) checked @endif required>
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
	                @if($pemeriksaanGigi->rujukan == 1)
	                	<textarea id="deskripsi" class="form-control" name="deskripsi">@if(isset($pemeriksaanGigi->detailRujukan->deskripsi)){{$pemeriksaanGigi->detailRujukan->deskripsi}}@endif</textarea>
	                @elseif($pemeriksaanGigi->rujukan == 0)
	                	<textarea id="deskripsi" class="form-control" name="deskripsi" readonly="readonly"></textarea>
	                @endif
	                <span class="form-text text-muted">Isikan deskripsi ketika siswa perlu dirujuk</span>
				</div>
	        </div>
		</div>
		<div class="card-footer text-right">
			<button type="button" class="btn btn-secondary">Back</button>
	        <button id="pemeriksaanGigiUpdate" type="button" class="btn bg-primary">Submit form</button>
        </div>
    	</form>
	</div>
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function(){

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


			let fs = [];
			fs["dmf"] = {{ $dmfD+$dmfM+$dmfF }};
			fs["def"] = {{ $defD+$defE+$defF }};


			var name = @json($posisiGd);
			var value = @json($keadaanGd);

			$(".gigi_dewasa").on('change',function(){
				const attrName = $(this).attr('name');
				const attrValue = $(this).val();
				if(name.includes(attrName) == true)
				{
					var index = name.indexOf(attrName);
					console.log(index);
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

				const dmf = D+M+F;
				fs["dmf"] = dmf;


				if (fs["dmf"] > 1 && fs["def"] > 4){
					$('.fsPlus').prop('checked',true);
					$('.fsMinus').prop('checked',false);
				} else {
					$('.fsPlus').prop('checked',false);
					$('.fsMinus').prop('checked',true);
				}

				const zero = value.filter(function(angka){
					return angka == "";
				}).length;
				$('input[name="jumlahGigiPermanen"]').val(value.length - zero);
				$('input[name="jumlahDmfT"]').val(dmf);
			});

			let nameGigiSulung = @json($posisiGs);
			let valueGigiSulung = @json($keadaanGs);
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

				const def = D+E+F;
				fs["def"] = def;

				if (fs["dmf"] > 1 && fs["def"] > 4){
					$('.fsPlus').prop('checked',true);
					$('.fsMinus').prop('checked',false);
				} else {
					console.log("baik");
					$('.fsPlus').prop('checked',false);
					$('.fsMinus').prop('checked',true);
				}

				var zero = valueGigiSulung.filter(function(angka){
					return angka == "";
				}).length;
				$('input[name="jumlahGigiSulung"]').val(valueGigiSulung.length - zero);
				$('input[name="jumlahDefT"]').val(def);
			})

			let indeksName = @json($debrisKalkulus);
			let indeksValue = @json($debrisKalkulusValue);

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
				const ohis = (jumlah/(indeksValue.length - zero)).toFixed(1);
				$('.ohis').val(ohis);

				if(ohis >= 0 && ohis <=1.2)
				{
					console.log("baik");
					$('.radio_baik').prop('checked',true);
					$('.radio_cukup').prop('checked',false);
					$('.radio_kurang').prop('checked',false);
				}else if( ohis >= 1.3 && ohis <=3)
				{
					console.log("cukup");
					$('.radio_baik').prop('checked',false);
					$('.radio_cukup').prop('checked',true);
					$('.radio_kurang').prop('checked',false);
				}else{
					console.log("Kurang");
					$('.radio_kurang').prop('checked',true);
					$('.radio_baik').prop('checked',false);
					$('.radio_cukup').prop('checked',false);
				}
			});

			$('#pemeriksaanGigiUpdate').on('click',function(){
				const editForm = $('#pemeriksaanGigiForm');
                editForm.validate({
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

				if (editForm.valid()) {
					function getValue(name){
						const val = document.getElementsByName(name);
						for (var i = 0; i < val.length; i++) {
							if(val[i].checked){
								return val[i].value;
							}
						}
					}

					const exoPers = getValue('exoPers');
					const fs = getValue('fs');
					console.log(fs);
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
					const kesehatanGusi = getValue('kesehatanGusi');
					const menyikatGigi = getValue('menyikatGigi');
					const rujukan = getValue('rujukan');
					const deskripsi = $("#deskripsi").val();
					
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
						url : '{{ route('pemeriksaanGigi.update',$pemeriksaanGigi->pemeriksaan_id) }}',
						method : 'POST',
						data : {
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
							gigiJson: gigiJson,
							deskripsi: deskripsi,
							_token: '{{ csrf_token() }}',
							_method: 'PUT'
						},
						success : function(response){
							Swal.fire({
                                type: 'success',
                                title : response,
                            }).then(function(){
                            	location.href = '{{ url('pemeriksaan/'.$id.'/periksa/'.$sekolahId) }}';
                            });
						},
						error:function(xhr,status,error){
                            Swal.fire({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
					})
				}
			})
		});
	</script>
@endsection