@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Sekolah</span> - Tambah data baru</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<a href="{{ URL::to('/sekolah') }}" class="breadcrumb-item"></i> Sekolah</a>
		        		<span class="breadcrumb-item active">Tambah sekolah</span>
		      		</div>
		      		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Sekolah</h5>
			<div class="header-elements">
				<div class="list-icons">
            		<a class="list-icons-item" data-action="collapse"></a>
            		<a class="list-icons-item" data-action="reload"></a>
            		<a class="list-icons-item" data-action="remove"></a>
            	</div>
        	</div>
		</div>

		<div class="card-body">
			<form action="{{ route('sekolah.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>NPSN :</label>
					<input type="text" class="form-control" placeholder="Silahkan masukan NPSN sekolah" name="npsn">
				</div>
				<div class="form-group">
					<label>Nama Sekolah :</label>
					<div class="row">
						<div class="col-md-3">
							<select class="form-control" name="sekolahType">
								<option value="SD">SD/MI</option>
								<option value="SMP">SMP/MTs</option>
								<option value="SMA">SMA/SMK/MA</option>
							</select>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" placeholder="Silahkan masukan nama sekolah" name="sekolahName">	
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Kelurahan :</label>
					<select class="form-control" name="kelurahan">
						<option>Pilih Kelurahan</option>
						@for($i = 0;$i < count($kelurahan);$i++)
							<option value="{{ $kelurahan[$i]->kelurahan_id }}">{{ $kelurahan[$i]->kelurahan_name }}</option>
						@endfor
					</select>
				</div>
				<div class="form-group">
					<label>Alamat :</label>
					<input type="text" class="form-control" placeholder="Silahkan masukan alamat sekolah" name="alamat">
				</div>
				<div class="form-group">
					<label>Kecamatan :</label>
					<input type="text" class="form-control" placeholder="Silahkan masukan kecamatan sekolah" name="kecamatan">
				</div>
				<div class="form-group">
					<label>Kota Administrasi</label>
					<input type="text" class="form-control" placeholder="Silahkan masukan kota administrasi sekolah" name="kotaAdministrasi">
				</div>
				<div class="text-right">
					<button class="btn btn-warning" action="{{ URL::to('/sekolah') }}">Back</button>
					<button type="submit" class="btn btn-primary">Submit<i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
@endsection