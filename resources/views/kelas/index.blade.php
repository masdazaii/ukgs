@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - <span class="font-weight-semibold">{{ $sekolah->sekolah_name }}</span> - Kelas</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/sekolah') }}" class="breadcrumb-item"></i> Sekolah</a>
		        		<span class="breadcrumb-item active">Kelas</span>
		      		</div>
		      		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
        	<button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical">Tambah kelas baru</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal_form_vertical" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('kelas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input id="kelasName" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="kelasName">
                            <input type="hidden" name="sekolahId" value="{{ $sekolah->sekolah_id }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->

    <div id="modal_form_vertical_edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input id="kelasNameEdit" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="kelasName">
                            <input id="sekolahId" type="hidden" name="sekolahId" value="{{ $sekolah->sekolah_id }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
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
            console.log("bangsat");
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('sekolah/'.$sekolah->sekolah_id.'/kelasAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'kelas_id',name:'kelas_id'},
                    {data: 'sekolah_id', name: 'sekolah_id'},
                    {data: 'kelas_name', name: 'kelas_name'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });
        });

        $(document).on('click','.edit',function(){
            var id = $(this).data("id");
            var url = '{{ route('kelas.update',':id') }}';
            url = url.replace(':id',id);
            $.ajax({
                url : "{{ url('kelasEditAjax') }}",
                headers : "{{ csrf_token() }}",
                method : 'get',
                data: {id:id},
                success : function(data){
                    console.log(data);
                    $("#kelasNameEdit").val(data.kelas_name);
                    $("#sekolahId").val(data.sekolah_id);
                    $("#editForm").attr('action',url);
                    $("#modal_form_vertical_edit").modal('show');
                }

            });
        });

        $(document).on('click','.delete',function(){
            var id = $(this).data("id");
            var alamat = '{{ route('kelas.destroy',':id') }}';
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