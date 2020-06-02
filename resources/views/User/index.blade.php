@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - User</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">User</span>
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
                            <th>Email</th>
                            <th>Nama</th>
                            <th>No Telp</th>
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
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('userAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'email', name: 'email'},
                    {data: 'name', name: 'name'},
                    {data: 'no_telp', name: 'no_telp'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });
        });

        $(document).on('click','.changeStatus',function(){
            let btn = $(this);
            const id = $(this).data("id");
            let uri = '{{ url('changeStatus') }}';
            console.log(uri);
            $.ajax({
                url : uri,
                method : 'GET',
                data:{
                    id:id
                },
                success:function(response){
                    $("#table").DataTable().ajax.reload();
                    Swal.fire({
                        type: 'success',
                        title : response,
                    });
                }
            })
        })
	</script>
@endsection
