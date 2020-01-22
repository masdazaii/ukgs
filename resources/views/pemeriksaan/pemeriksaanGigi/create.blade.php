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
		<div class="card-header">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-form-label col-md-2" >Basic select</label>
						<div class="col-md-10">
							<select class="form-control select" data-fouc>
								@for($i=0; $i < count($kelas); $i++)
									<option value="{{ $kelas[$i]->kelas_id }}">{{ $kelas[$i]->kelas_name }}</option>
								@endfor
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-form-label col-md-2" >Basic select</label>
						<div class="col-md-10">
							<select class="form-control select" data-fouc>
								<option value="AL">Alabama</option>
								<option value="AR">Arkansas</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row d-flex">
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Sekolah</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Kelas</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Nama</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Jenis kelamin</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Usia</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-12">
					<label class="col-form-label col-sm-2">Alamat</label>
					<input type="text" class="form-control col-sm-10" readonly value="SD N 1 Purwokerto">
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		{{-- Indeks Karies --}}
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
						<td class="gigi_kosong">1</td>
						<td class="gigi_kosong">2</td>
						<td class="gigi_kosong">3</td>
						<td class="gigi_kosong">4</td>
						<td class="gigi_kosong">5</td>
						<td class="gigi_kosong">6</td>
						<td class="gigi_kosong">7</td>
						<td class="gigi_kosong">8</td>
						<td class="gigi_kosong">9</td>
						<td class="gigi_kosong">10</td>
						<td class="gigi_kosong">1</td>
						<td class="gigi_kosong">2</td>
						<td class="gigi_kosong">3</td>
						<td class="gigi_kosong">4</td>
						<td class="gigi_kosong">5</td>
						<td class="gigi_kosong">6</td>
					</tr>
					<tr class="gigi_border">
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
					</tr>
					<tr>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong">4</td>
						<td class="gigi_kosong">5</td>
						<td class="gigi_kosong">6</td>
						<td class="gigi_kosong">7</td>
						<td class="gigi_kosong">8</td>
						<td class="gigi_kosong">9</td>
						<td class="gigi_kosong">10</td>
						<td class="gigi_kosong">1</td>
						<td class="gigi_kosong">2</td>
						<td class="gigi_kosong">3</td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_kosong">
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong">1</td>
						<td class="gigi_kosong">2</td>
						<td class="gigi_kosong">3</td>
						<td class="gigi_kosong">4</td>
						<td class="gigi_kosong">5</td>
						<td class="gigi_kosong">6</td>
						<td class="gigi_kosong">7</td>
						<td class="gigi_kosong">8</td>
						<td class="gigi_kosong">9</td>
						<td class="gigi_kosong">10</td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
					</tr>
					<tr>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_border">
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select></td>
					</tr>
				</table>
				<div class="row mt-3">
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi sulung</label>
						<input type="text" class="form-control col-sm-6" readonly value="2">
						<label class="col-sm-4 col-form-label mt-1">Skor def-t</label>
						<div class="col-sm-6 mt-1">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">d</label>
								<input class="form-control col-xs-10 text-center">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">e</label>
								<input class="form-control col-xs-10 text-center">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">f</label>
								<input class="form-control col-xs-10 text-center">
							</div>
						</div>
					</div>
					<div class="form-group row col-md-6">
						<label class="col-sm-4 col-form-label">Jumlah gigi permanen</label>
						<input type="text" class="form-control col-sm-6" readonly value="2">
						<label class="col-sm-4 col-form-label mt-1">Skor DMF-T</label>
						<div class="col-sm-6 mt-1">
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">D</label>
								<input class="form-control col-xs-10 text-center">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">M</label>
								<input class="form-control col-xs-10 text-center">
							</div>
							<div class="form-group row col-xs-12">
								<label class="col-xs-2 col-form-label">F</label>
								<input class="form-control col-xs-10 text-center">
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
			<div class="container-fluid">
			<div class="row d-flex mb-3">
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Debris</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-sm-4">
								<input class="col-sm-4">
								<input class="col-sm-4">
							</tr>
							<tr>
								<input class="col-sm-4">
								<input class="col-sm-4">
								<input class="col-sm-4">
							</tr>
						</table>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<label class="col-md-3 col-form-label">Indeks Kalkulus</label>
					<div class="col-md-9">
						<table class="table table-responsive">
							<tr>
								<input class="col-md-4">
								<input class="col-md-4">
								<input class="col-md-4">
							</tr>
							<tr>
								<input class="col-md-4">
								<input class="col-md-4">
								<input class="col-md-4">
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group row col-md-6">
					<label class="col-sm-3 col-form-label">OHI-S (DI + CI)</label>
					<input type="text" class="form-control col-sm-9" readonly value="SD N 1 Purwokerto">
				</div>
				<div class="form-group row col-md-6 ml-2">
					<div class="form-group pt-2">
						<label class="font-weight-semibold">Left stacked styled</label>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Baik (0-1,2)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Cukup (1,3-3)
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Kurang (3-6)
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
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Sehat tidak ada kelainan
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Persistensi pada gigi
							</label>
							<input type="text" name="persistensi" class="form-control" disabled>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Karies pada gigi
							</label>
							<input type="text" name="kariespadagigi" class="form-control" disabled>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="radio" class="form-check-input-styled" name="stacked-radio-left" data-fouc>
								Rampan karies
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
						<h5 class="no-margin-bottom">Kasus Gigi dan Mulut</h5>
					</div>
				</div>
				<div class="form-group row col-md-6">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							Baik
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							Ringan
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							Sedang
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
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
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							1
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							2
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
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
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							+
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
							-
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button type="button" class="btn btn-secondary">Close</button>
	        <button type="Submit" class="btn btn-primary">Submit</button>
        </div>
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
@endsection