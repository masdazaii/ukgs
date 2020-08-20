@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Cek Laporan</span></h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ url('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">cek laporan</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Cek Laporan</h5>
			<div class="header-elements">
				<div class="list-icons">
            		<a class="list-icons-item" data-action="collapse"></a>
            	</div>
        	</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama sekolah</label>
                            <input id="search" type="text" class="form-control" placeholder="Masukan nama sekolah">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Tahun ajaran</label>
                            <select id="tahunAjaran" class="form-control">
                                <option>Silahkan pilih tahun ajaran</option>
                                @for($i = 0; $i < count($tahunAjaran); $i++)
                                    <option value="{{ $tahunAjaran[$i]->tahun_ajaran_id }}">{{ $tahunAjaran[$i]->tahun_ajaran }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <table class="table table-bordered mt-3">
                    	<thead>
                    		<tr>
                    			<th class="bg-danger text-center">Belum diperiksa</th>
                    			<th class="bg-warning text-center">Sedang diperiksa</th>
								<th class="bg-success text-center">Sudah diperiksa</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		<tr>
                    			<td id="belumDiperiksa"></td>
                    			<td id="sedangDiperiksa"></td>
                    			<td id="sudahDiperiksa"></td>
                    		</tr>
                    	</tbody>
                    </table>
				</div>
				<div class="col-md-6 text-center">
					<button href="" style="height: 150px; width: 150px;" class="btn btn-success download" disabled>
						<i class="icon-file-download2 icon-5x"></i>
					</button>
					<span class="form-text text-muted text-center">*Data yang diunduh hanya siswa yang sudah diperiksa</span>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('librariesJS')
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
            const swalInit = swal.mixin({
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-light'
            });

            let tempSekolah = null;
			let data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace("sekolah_id","sekolah_name"),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url:'{{ url('typeahead') }}'+'?term=%QUERY',
                    wildcard:'%QUERY'
                }
            })

            data.initialize();

            $('#search').typeahead(
                {
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name:'sekolah',
                    displayKey:'sekolah_name',
                    source: data.ttAdapter()
                }
            ).on('typeahead:selected',function(event,data){
            	tempSekolah = data.sekolah_id;
            })

            $("#tahunAjaran").on('change',function(){
                const tahunAjaran = $(this).val();
                let downloadUrl = '{{ route('laporan',[':id',':tahunAjaran']) }}';
                downloadUrl = downloadUrl.replace(':id',tempSekolah);
                downloadUrl = downloadUrl.replace(':tahunAjaran',tahunAjaran);
                $.ajax({
                    url : '{{ url('cekPeriksaSekolah') }}',
                    type : 'GET',
                    data : {
                        sekolahId : tempSekolah,
                        tahunAjaran : tahunAjaran
                    },
                    success : function(response){
                        if(response.sudahDiperiksa > 0){
                            $('.download').attr('href',downloadUrl);
                            $('.download').attr('disabled',false);
                        }else{
                            swalInit({
                                type: 'warning',
                                title : "Tidak ada data yang dapat diunduh",
                            });
                        }

                        document.getElementById('belumDiperiksa').innerText = response.belumDiperiksa;
                        document.getElementById('sedangDiperiksa').innerText = response.sedangDiperiksa;
                        document.getElementById('sudahDiperiksa').innerText = response.sudahDiperiksa;
                    }
                })





            })

            $('.download').on('click',function(){
                const url = $(this).attr("href");
                location.href = url;
            })
		})
	</script>
@endsection
