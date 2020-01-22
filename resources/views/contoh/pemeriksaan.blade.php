@extends('layouts.app')
@section('content')
	<header class="card">
	  <div class="container-fluid">
	    	<h2 class="no-margin-bottom">Pemeriksaan Gigi</h2>
	    	{{-- <div class="breadcrumb-holder">
	        	<div class="container-fluid">
		          	<ul class="breadcrumb">
		            	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
		            	<li class="breadcrumb-item active">Forms       </li>
		          	</ul>
		        </div>
	      	</div> --}}
	  </div>
	</header>
	<div class="card">
		<div class="card-header">
			<div class="row d-flex">
				<div class="form-group row col-md-6">
					<label class="col-sm-2 form-control-label">Pilih Kelas</label>
	                <div class="col-sm-10 mb-3">
	                    <select name="account" class="form-control">
	                      <option>SMP N 1</option>
	                      <option>SMP N 2</option>
	                      <option>SMP N 3</option>
	                      <option>SMP N 4</option>
	                    </select>
	                </div>
				</div>
				<div class="form-group row col-md-6">
					<label class="col-sm-2 form-control-label">Pilih siswa</label>
	                <div class="col-sm-10 mb-3">
	                    <select name="account" class="form-control">
	                      <option>Adnan</option>
	                      <option>Nanda</option>
	                      <option>Danan</option>
	                      <option>Nanad</option>
	                    </select>
	                </div>
				</div>
			</div>
			<div class="row d-flex">
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Sekolah</label>
					<div class="col-sm-10">: SD N 1 Purwokerto</div>
				</div>
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Kelas</label>
					<div class="col-sm-10">: 5B</div>
				</div>
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Nama</label>
					<div class="col-sm-10">: Adnan Punjabi</div>
				</div>
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Jenis kelamin</label>
					<div class="col-sm-10">: Laki-laki</div>
				</div>
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Usia</label>
					<div class="col-sm-10">: 9</div>
				</div>
				<div class="form-group row col-md-12">
					<label class="col-sm-2 form-control-label">Alamat</label>
					<div class="col-sm-10">: JL Gatot Subroto No IV RT V/VI</div>
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
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_kosong gigi_nomer_atas"></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select>
						</td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
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
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
						<td class="gigi_kosong"></td>
					</tr>
					<tr class="gigi_border">
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
						<td class="gigi_border">
							<select class="form-control-sm gigi_select">
								<option>&#xf057</option>
								<option>&#xf00c</option>
								<option>&#xf111</option>
							</select></td>
					</tr>
				</table>
				<div class="row d-flex">
					<div class="form-group row col-md-6">
						<label class="col-sm-4 form-control-label">Jumlah gigi sulung</label>
						<div class="col-sm-6">: 2</div>
						<label class="col-sm-4 form-control-label">Skor def-t</label>
						<div class="col-sm-12">
							<div class="col-xs-4 text-center">
								<label> 
									d = <input class="col-xs-2 text-center">
								</label>
							</div>
							<div class="col-xs-4 text-center">
								<label> 
									e = <input class="col-xs-2 text-center">
								</label>
							</div>
							<div class="col-xs-4 text-center">
								<label> 
									f = <input class="col-xs-2 text-center">
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row col-md-6">
						<label class="col-sm-4 form-control-label">Jumlah gigi permanen</label>
						<div class="col-sm-6">: 2</div>
						<label class="col-sm-4 form-control-label">Skor DMF-T</label>
						<div class="col-sm-12">
							<div class="col-xs-4 text-center">
								<label> 
									D = <input class="col-xs-2 text-center">
								</label>
							</div>
							<div class="col-xs-4 text-center">
								<label> 
									M = <input class="col-xs-2 text-center">
								</label>
							</div>
							<div class="col-xs-4 text-center">
								<label> 
									F = <input class="col-xs-2 text-center">
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row d-flex">
				<div class="container-fluid">
					<h5 class="no-margin-bottom">Indeks kebersihan mulut (OHI-S)</h5>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="container-fluid">
			<div class="row d-flex mb-3">
				<div class="form-group row col-md-6">
					<label class="col-md-3 form-control-label">Indeks Debris</label>
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
					<label class="col-md-3 form-control-label">Indeks Kalkulus</label>
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
			<div class="row d-flex mb-3">
				<div class="form-group row col-md-6">
					<label class="col-sm-2 form-control-label">OHI-S</label>
					<div class="col-sm-10">= DI + CI</div>
					<label class="col-sm-2 form-control-label"></label>
					<div class="col-sm-10">= 7</div>
				</div>
				<div class="form-group row col-md-6">
					<div class="col-sm-10">
						<div class="i-checks">
	                        <input id="radioCustom1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
	                        <label for="radioCustom1">Baik (0-1,2) </label>
	                    </div>
	                    <div class="i-checks">
	                        <input id="radioCustom2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
	                        <label for="radioCustom2">Cukup (1,3-3)</label>
	                    </div>
	                    <div class="i-checks">
	                        <input id="radioCustom3" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
	                        <label for="radioCustom3">Kurang (3-6)</label>
	                    </div>
                    </div>
				</div>
			</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row d-flex">
				<div class="container-fluid">
					<h5 class="no-margin-bottom">Kasus Gigi dan Mulut</h5>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<div class="row d-flex">
					<div class="form-group row col-md-12">
						<div class="col-sm-10">
							<div class="i-checks">
		                        <input id="radioCustom1a" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
		                        <label for="radioCustom1a">Sehat tidak ada kelainan </label>
		                    </div>
		                    <div class="i-checks">
		                        <input id="radioCustom2a" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
		                        <label for="radioCustom2a"> Persistensi pada gigi <input id="register-email" type="email" name="registerEmail" required class="input-material col-md-2"></label>
		                    </div>
		                    <div class="i-checks">
		                        <input id="radioCustom3a" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
		                        <label for="radioCustom3a">
		                        	Karies pada gigi <input id="register-email" type="email" name="registerEmail" required class="input-material col-md-2">
		                        </label>
		                    </div>
		                    <div class="i-checks">
		                        <input id="radioCustom4" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
		                        <label for="radioCustom4">Rampan karies</label>
		                    </div>
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
					<div class="i-checks">
	                    <input id="radioCustomKasus1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
	                    <label for="radioCustomKasus1">Sehat </label>
	                </div>
	                <div class="i-checks">
	                    <input id="radioCustomKasus2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
	                    <label for="radioCustomKasus2">Ringan </label>
	                </div>
	                <div class="i-checks">
	                    <input id="radioCustomKasus3" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
	                    <label for="radioCustomKasus3">Sedang </label>
	                </div>
	                <div class="i-checks">
	                    <input id="radioCustomKasus4" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
	                    <label for="radioCustomKasus4">Berat</label>
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
					<div class="i-checks">
	                    <input id="frekuensi1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
	                    <label for="frekuensi1">1</label>
	                </div>
	                <div class="i-checks">
	                    <input id="frekuensi2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
	                    <label for="frekuensi2">2</label>
	                </div>
	                <div class="i-checks">
	                    <input id="frekuensi3" type="radio" value="option3" name="a" class="form-control-custom radio-custom">
	                    <label for="frekuensi3">3</label>
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
					<div class="i-checks">
	                    <input id="rujukan1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
	                    <label for="rujukan1">+</label>
	                </div>
	                <div class="i-checks">
	                    <input id="rujukan2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
	                    <label for="rujukan2">-</label>
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