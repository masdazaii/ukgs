@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Kelas</span> - Edit data kelas</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<a href="{{ URL::to('/sekolah') }}" class="breadcrumb-item"></i> Sekolah</a>
		        		<a href="{{ URL::to('/kelas') }}" class="breadcrumb-item"></i> Kelas</a>
		        		<span class="breadcrumb-item active">Edit kelas</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Kelas</h5>
			<div class="header-elements">
				<div class="list-icons">
            		<a class="list-icons-item" data-action="collapse"></a>
            		<a class="list-icons-item" data-action="reload"></a>
            		<a class="list-icons-item" data-action="remove"></a>
            	</div>
        	</div>
		</div>

		<div class="card-body">
			<form action="{{ route('kelas.update',$kelas->kelas_id) }}" method="post" enctype="multipart/form-data">
				@csrf
				{{ method_field('PUT') }}
				<div class="form-group">
					<label>NPSN :</label>
					<input type="text" class="form-control" value="{{ $sekolah->npsn }}" placeholder="Silahkan masukan NPSN sekolah" name="npsn">
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-3">
							<label>Jenjang Sekolah :</label>
							<select class="form-control" name="sekolahType">
								@for($i =0;$i < count($tipeSekolah);$i++)
									@if( $sekolah->sekolah_type == $tipeSekolah[$i])
										<option value="{{ $tipeSekolah[$i] }}" selected>{{ $tipeSekolah[$i] }}</option>
									@else
										<option value="{{ $tipeSekolah[$i] }}"> {{ $tipeSekolah[$i] }} </option>
									@endif
								@endfor
							</select>
						</div>
						<div class="col-md-9">
							<label>Nama Sekolah :</label>
							<input type="text" value="{{ $sekolah->sekolah_name }}" class="form-control" placeholder="Silahkan masukan nama sekolah" name="sekolahName">	
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat :</label>
					<input type="text" class="form-control" value="{{ $sekolah->alamat }}" placeholder="Silahkan masukan alamat sekolah" name="alamat">
				</div>
				<div class="form-group">
					<label>Kecamatan :</label>
					<input type="text" class="form-control" value="{{ $sekolah->kecamatan }}" placeholder="Silahkan masukan kecamatan sekolah" name="kecamatan">
				</div>
				<div class="form-group">
					<label>Kota Administrasi</label>
					<input type="text" class="form-control"  value="{{ $sekolah->kota_administrasi }}" placeholder="Silahkan masukan kota administrasi sekolah" name="kotaAdministrasi">
				</div>
				<div class="text-right">
					<button class="btn btn-warning" action="{{ URL::to('/sekolah') }}">Back</button>
					<button type="submit" class="btn btn-primary">Submit<i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
@endsection