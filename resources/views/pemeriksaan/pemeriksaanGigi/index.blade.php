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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>NPSN</th>
                            <th>Nama Sekolah</th>
                            <th>Kota Administrasi</th>
                            <th>Status</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form id="post-form" action="" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
@section('librariesJS')
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script type="text/javascript" src="{{ asset('limitless/global_assets/js/demo_pages/components_dropdowns.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('/pemeriksaanGigiSekolahAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'npsn',name:'npsn'},
                    {data: 'sekolah_name', name: 'sekolah_name'},
                    {data: 'kota_administrasi', name: 'kota_administrasi'},
                    {data: 'status', name:'status'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });
        });

        $(document).on('click','.pilih',function(){
            event.preventDefault();
            var id = $(this).data('id');
            var url = '{{ url('/pemeriksaanGigi/'.':id'.'/periksa') }}';
            url = url.replace(':id',id);
            console.log(url);
            $('#post-form').attr('action',url);
            $('#post-form').submit();
        })
	</script>
@endsection