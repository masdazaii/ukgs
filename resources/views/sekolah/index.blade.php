@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Sekolah</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Sekolah</span>
		      		</div>
		      		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-left">
                        <a class="btn btn-primary" href="{{URL::to('/sekolah/create')}}"><i class="icon-plus22 mr-1"></i> Tambah data sekolah baru</a>
                    </div>      
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <button id="excel" class="btn btn-success"><i class="icon-file-excel mr-1"></i>Input Obat dengan excel</button>
                    </div>
                </div>
            </div>
            <div id="excelForm" class="card mt-3" style="display: none;">
                <div class="card-header">
                    <p class="font-weight-semibold">Single file upload example:</p>
                </div>
                <div class="card-body">
                    <form action="{{ url('importExcelSekolah') }}" class="dropzone" id="dropzone">@csrf</form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">
                                ID
                            </th>
                            <th>NPSN</th>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>Kota Administrasi</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/components_dropdowns.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
            console.log("cek ready");
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('sekolahAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'sekolah_id', name: 'sekolah_id'},
                    {data: 'npsn', name: 'npsn'},
                    {data: 'sekolah_name', name: 'sekolah_name'},
                    {data: 'alamat', name: 'alamat'},
                    {data: 'kecamatan', name: 'kecamatan'},
                    {data: 'kota_administrasi', name: 'kota_administrasi'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

            $('#excel').on('click',function(){
                $('#excelForm').toggle();
            });
        });

        Dropzone.options.dropzone = {
            url : '{{ url('importExcelSekolah') }}',
            renameFile: function(file){
                var date = new Date();
                var time = date.getTime();
                return time+file.name;
            },
            acceptedFiles: ".xls,.xlsx",
            success : function(file,response){
                console.log(response);
                $('#excelForm').toggle();
                Swal.fire({
                    type: 'success',
                    title : 'Data dalam excel berhasil ditambahkan',
                });
            }
        }

        $(document).on('click','.delete',function(){
            var id = $(this).data("id");
            var alamat = '{{ route('sekolah.destroy',':id') }}';
            alamat = alamat.replace(':id',id);
            $.ajax({
                url : alamat,
                type: 'POST',
                data: {
                    id:id,
                    _token:'{{ csrf_token() }}',
                    _method: 'Delete'
                },
                success: function(){
                    $("#table").DataTable().ajax.reload();
                    Swal.fire({
                        type: 'success',
                        title : 'Data sekolah berhasil dihapus',
                    });
                }
            })
        })
	</script>
@endsection