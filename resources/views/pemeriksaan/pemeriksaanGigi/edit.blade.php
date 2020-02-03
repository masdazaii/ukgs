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
		<input type="hidden" name="sekolahId" value="{{ $detailPemeriksaanGigi->sekolah_id }}">
		<input type="hidden" name="kelasId" value="{{ $detailPemeriksaanGigi->kelas_id }}">
		<input type="hidden" name="pemeriksaanGigiId" value="{{ $detailPemeriksaanGigi->pemeriksaan_gigi_id }}">
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
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=21;$i<=28;$i++)
							@php
								$table = 'gda'.$i;
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gda{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->gda.$i == 4) selected @endif>
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
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=61;$i<=65;$i++)
							@php
								$table = 'gsa'.$i;
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsa{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
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
								$table = 'gsb'.$i;
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=71;$i<=75;$i++)
							@php
								$table = 'gsb'.$i;
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_sulung" name="gsb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
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
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
										4
									</option>
								</select>
							</td>
						@endfor
						@for($i=41;$i<=48;$i++)
							@php
								$table = 'gdb'.$i;
							@endphp
							<td class="gigi_border">
								<select class="form-control-sm gigi_select gigi_dewasa" name="gdb{{$i}}">
									<option type="provider"></option>
									<option value="1" @if($detailPemeriksaanGigi->indekKaries->$table == 1) selected @endif>
										1
									</option>
									<option value="2" @if($detailPemeriksaanGigi->indekKaries->$table == 2) selected @endif>
										2
									</option>
									<option value="3" @if($detailPemeriksaanGigi->indekKaries->$table == 3) selected @endif>
										3
									</option>
									<option value="4" @if($detailPemeriksaanGigi->indekKaries->$table == 4) selected @endif>
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
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiSulung" value="{{ $detailPemeriksaanGigi->jumlah_gigi_sulung }}">
						<label class="col-sm-4 col-form-label mt-1">Skor def-t</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDefT" value="{{ $detailPemeriksaanGigi->jumlah_def_t }}">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1 text-right">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">d</label>
								<input class="form-control col-xs-10 text-center defD" name="defD" value="{{ $detailPemeriksaanGigi->def_d}}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">e</label>
								<input class="form-control col-xs-10 text-center defE" name="defE" value="{{ $detailPemeriksaanGigi->def_e}}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">f</label>
								<input class="form-control col-xs-10 text-center defF" name="defF" value="{{ $detailPemeriksaanGigi->def_f }}">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">Exo Pers</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input-styled" value="0" @if($detailPemeriksaanGigi->exo_pers == 0) checked @endif name="exoPers" data-fouc required>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input-styled" value="1" @if($detailPemeriksaanGigi->exo_pers == 1) checked @endif name="exoPers" data-fouc required>
									-
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi permanen</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahGigiPermanen" value="{{ $detailPemeriksaanGigi->jumlah_gigi_permanen }}">
						<label class="col-sm-4 col-form-label mt-1">Skor DMF-T</label>
						<input type="text" class="form-control col-sm-6" readonly name="jumlahDmfT" value="{{ $detailPemeriksaanGigi->jumlah_dmf_t }}">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-6 mt-1">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">D</label>
								<input class="form-control col-xs-10 text-center dmfD" name="dmfD" value="{{ $detailPemeriksaanGigi->dmf_d}}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">M</label>
								<input class="form-control col-xs-10 text-center dmfM" name="dmfM" value="{{ $detailPemeriksaanGigi->dmf_m}}">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">F</label>
								<input class="form-control col-xs-10 text-center dmfF" name="dmfF" value="{{ $detailPemeriksaanGigi->dmf_f}}">
							</div>
						</div>
						<label class="col-sm-4 col-form-label">FS</label>
						<div class="col-sm-8">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input-styled fsPlus" value="0" @if($detailPemeriksaanGigi->fs == 0) checked @endif name="fs" data-fouc required>
									+
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input-styled fsMinus" value="1" @if($detailPemeriksaanGigi->fs == 0) checked @endif name="fs" data-fouc required>
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
								<input class="col-sm-4 debris_kalkulus" name="debris1" required value="{{ $detailPemeriksaanGigi->debris_1}}">
								<input class="col-sm-4 debris_kalkulus" name="debris2" required value="{{ $detailPemeriksaanGigi->debris_2}}">
								<input class="col-sm-4 debris_kalkulus" name="debris3" required value="{{ $detailPemeriksaanGigi->debris_3}}">
							</tr>
							<tr>
								<input class="col-sm-4 debris_kalkulus" name="debris4" required value="{{ $detailPemeriksaanGigi->debris_4}}">
								<input class="col-sm-4 debris_kalkulus" name="debris5" required value="{{ $detailPemeriksaanGigi->debris_5}}">
								<input class="col-sm-4 debris_kalkulus" name="debris6" required value="{{ $detailPemeriksaanGigi->debris_6}}">
							</tr>
						</table>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Kalkulus</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus1" required value="{{ $detailPemeriksaanGigi->kalkulus_1}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus2" required value="{{ $detailPemeriksaanGigi->kalkulus_2}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus3" required value="{{ $detailPemeriksaanGigi->kalkulus_3}}">
							</tr>
							<tr>
								<input class="col-md-4 debris_kalkulus" name="kalkulus4" required value="{{ $detailPemeriksaanGigi->kalkulus_4}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus5" required value="{{ $detailPemeriksaanGigi->kalkulus_5}}">
								<input class="col-md-4 debris_kalkulus" name="kalkulus6" required value="{{ $detailPemeriksaanGigi->kalkulus_6}}">
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group row col-md-6">
					<label class="col-sm-3 col-form-label">OHI-S (DI + CI)</label>
					<input type="text" class="form-control col-sm-9 ohis" readonly value="{{ $detailPemeriksaanGigi->ohis}}" name="ohiS" required>
				</div>
				<div class="form-group row col-md-6 ml-2">
					<div class="form-group pt-2">
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled radio_baik" name="ohisDetail" @if($detailPemeriksaanGigi->ohis > 0 && $detailPemeriksaanGigi->ohis <= 1.2) checked @endif data-fouc disabled  required>
								Baik (0-1,2)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled radio_cukup" name="ohisDetail" @if($detailPemeriksaanGigi->ohis > 1.2 && $detailPemeriksaanGigi->ohis <= 3) checked @endif data-fouc disabled  required>
								Cukup (1,3-3)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled radio_kurang" name="ohisDetail" @if($detailPemeriksaanGigi->ohis > 3 && $detailPemeriksaanGigi->ohis <= 6) checked @endif data-fouc disabled  required>
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
		</div>
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
							<input type="radio" class="form-check-input-styled" value="0" name="kesehatanGusi" @if($detailPemeriksaanGigi->kesehatan_gusi == 0) checked @endif data-fouc>
							Baik
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="1" name="kesehatanGusi" @if($detailPemeriksaanGigi->kesehatan_gusi == 1) checked @endif data-fouc>
							Ringan
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="2" name="kesehatanGusi" @if($detailPemeriksaanGigi->kesehatan_gusi == 2) checked @endif data-fouc>
							Sedang
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="3" name="kesehatanGusi" @if($detailPemeriksaanGigi->kesehatan_gusi == 3) checked @endif data-fouc>
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
							<input type="radio" class="form-check-input-styled" value="1" name="menyikatGigi" @if($detailPemeriksaanGigi->frekuensi_menyikat_gigi == 1) checked @endif data-fouc required>
							1
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="2" name="menyikatGigi" @if($detailPemeriksaanGigi->frekuensi_menyikat_gigi == 2) checked @endif data-fouc required>
							2
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="3" name="menyikatGigi" @if($detailPemeriksaanGigi->frekuensi_menyikat_gigi == 3) checked @endif data-fouc required>
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
							<input type="radio" class="form-check-input-styled" value="0" name="rujukan" @if($detailPemeriksaanGigi->rujukan == 0) checked @endif data-fouc required>
							+
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" value="1" name="rujukan" @if($detailPemeriksaanGigi->rujukan == 1) checked @endif data-fouc required>
							-
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button type="button" class="btn btn-secondary">Back</button>
	        <button type="submit" class="btn bg-primary">Submit form</button>
        </div>
    	</form>
	</div>
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/form_select2.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/form_checkboxes_radios.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			//count fs plus or minus
			var fs = [];

			var name = [];
			var value = [];

			$.ajax({
				url : '{{ url('indekKariesGd',$detailPemeriksaanGigi->detail_pemeriksaan_gigi_id) }}',
				method : 'GET',
				success: function(data){
					console.log(data);
				}
			})

			$(".gigi_dewasa").on('change',function(){
				var attrName = $(this).attr('name');
				var attrValue = $(this).val();
				if(name.includes(attrName) == true)
				{
					var index = name.indexOf(attrName);
					value[index] = attrValue;
				}else{
					name.push(attrName);
					value.push(attrValue);
				}

				var D = value.filter(function(angka){
					return angka == 2;
				}).length;
				$(".dmfD").val(D);

				var M = value.filter(function(angka){
					return angka == 3;
				}).length;
				$(".dmfM").val(M);

				var F = value.filter(function(angka){
					return angka == 4;
				}).length;
				$(".dmfF").val(F);

				var dmf = D+M+F;
				fs["dmf"] = dmf;

				if (fs["dmf"] > 1 && fs["def"] > 4){
					console.log("anjing");
					$('.fsPlus').prop('checked',true).uniform('refresh');
					$('.fsMinus').prop('checked',false).uniform('refresh');
				} else {
					console.log("baik");
					$('.fsPlus').prop('checked',false).uniform('refresh');
					$('.fsMinus').prop('checked',true).uniform('refresh');
				}

				var zero = value.filter(function(angka){
					return angka == "";
				}).length;
				$('input[name="jumlahGigiPermanen"]').val(value.length - zero);
				$('input[name="jumlahDmfT"]').val(dmf);

				console.log(fs["dmf"]);
				console.log(fs);
			});

			var nameGigiSulung = [];
			var valueGigiSulung = [];
			$(".gigi_sulung").on('change',function(){
				var attrName = $(this).attr('name');
				var attrValue = $(this).val();
				if(nameGigiSulung.includes(attrName) == true)
				{
					var index = nameGigiSulung.indexOf(attrName);
					valueGigiSulung[index] = attrValue;
				}else{
					nameGigiSulung.push(attrName);
					valueGigiSulung.push(attrValue);
				}

				var D = valueGigiSulung.filter(function(angka){
					return angka == 2;
				}).length;
				$(".defD").val(D);

				var E = valueGigiSulung.filter(function(angka){
					return angka == 3;
				}).length;
				$(".defE").val(E);

				var F = valueGigiSulung.filter(function(angka){
					return angka == 4;
				}).length;
				$(".defF").val(F);

				var def = D+E+F;
				fs["def"] = def;

				if (fs["dmf"] > 1 && fs["def"] > 4){
					console.log("anjing");
					$('.fsPlus').prop('checked',true).uniform('refresh');
					$('.fsMinus').prop('checked',false).uniform('refresh');
				} else {
					console.log("baik");
					$('.fsPlus').prop('checked',false).uniform('refresh');
					$('.fsMinus').prop('checked',true).uniform('refresh');
				}

				var zero = valueGigiSulung.filter(function(angka){
					return angka == "";
				}).length;
				$('input[name="jumlahGigiSulung"]').val(valueGigiSulung.length - zero);
				$('input[name="jumlahDefT"]').val(def);

				console.log(fs["def"]);
				console.log(fs);
			})

			var indeksName = [];
			var indeksValue =[];

			$('.debris_kalkulus').keyup(function(){
				var name = $(this).attr('name');
				var value = $(this).val();
				var jumlah = 0;
				
				if(indeksName.includes(name) == true){
					var index = indeksName.indexOf(name);
					indeksValue[index] = value;
				}else{
					indeksName.push(name);
					indeksValue.push(value);
				}

				for(var i = 0; i < indeksValue.length ; i++ )
				{
					if(indeksValue[i] == "")
					{
						jumlah += 0;
					}else{
						jumlah += parseInt(indeksValue[i]);
					}
				}

				var zero = indeksValue.filter(function(angka){
					return angka == "";
				}).length;
				var ohis = (jumlah/(indeksValue.length - zero)).toFixed(1);
				console.log(ohis);
				$('.ohis').val(ohis);

				if(ohis >= 0 && ohis <=1.2)
				{
					console.log("baik");
					$('.radio_baik').prop('checked',true).uniform('refresh');
					$('.radio_cukup').prop('checked',false).uniform('refresh');
					$('.radio_kurang').prop('checked',false).uniform('refresh');
				}else if( ohis >= 1.3 && ohis <=3)
				{
					console.log("cukup");
					$('.radio_baik').prop('checked',false).uniform('refresh');
					$('.radio_cukup').prop('checked',true).uniform('refresh');
					$('.radio_kurang').prop('checked',false).uniform('refresh');
				}else{
					console.log("Kurang");
					$('.radio_kurang').prop('checked',true).uniform('refresh');
					$('.radio_baik').prop('checked',false).uniform('refresh');
					$('.radio_cukup').prop('checked',false).uniform('refresh');
				}
			});
		});
	</script>
@endsection