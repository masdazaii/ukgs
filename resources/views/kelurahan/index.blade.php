@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelurahan</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Kelurahan</span>
		      		</div>
		      		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
        	<button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical">Tambah kelurahan baru</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Kelurahan</th>
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
                    <h5 class="modal-title">Tambah Kelurahan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="createForm" action="{{ route('kelurahan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelurahan</label>
                            <input id="kelurahanName" type="text" placeholder="Silahkan masukan nama kelurahan" class="form-control" name="kelurahanName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <a type="submit" class="btn bg-primary submit">Submit form</a>
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
                    <h5 class="modal-title">Edit Kelurahan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama kelurahan</label>
                            <input id="kelurahanNameEdit" type="text" placeholder="Silahkan masukan nama kelurahan" class="form-control" name="kelurahanName" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <a type="submit" class="btn bg-primary editSubmit">Submit form</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
@endsection
@section('librariesJS')
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
@endsection
@section('script')
	<script>
        const swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

		$(document).ready(function() {
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('kelurahanAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'kelurahan_name', name: 'kelurahan_name'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });
        });

        $(document).on('click','.submit',function(){
            const createForm = $('#createForm');
            createForm.validate({
                errorClass: 'validation-invalid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });

            if(createForm.valid()){
                const kelurahanName = $('#kelurahanName').val();
                $.ajax({
                    url : '{{ route('kelurahan.store') }}',
                    method : 'POST',
                    data: {
                        kelurahanName:kelurahanName,
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(response){
                        $('#modal_form_vertical').modal('hide');
                        $("#table").DataTable().ajax.reload();
                        swalInit({
                            type: 'success',
                            title : response,
                        });
                    },
                    error: function(xhr){
                        swalInit({
                            type: 'error',
                            title : xhr.responseText,
                        });
                    }
                })
            }
        })

        $(document).on('click','.edit',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('kelurahan.update',':id') }}';
            alamat = alamat.replace(':id',id);
            $.ajax({
                url : '{{ url('kelurahanEditAjax') }}',
                headers : "{{ csrf_token() }}",
                method : 'get',
                data: {id:id},
                success : function(data){
                    $('#editForm').attr('action',alamat);
                    $('#modal_form_vertical_edit').modal('show');
                    $("#kelurahanNameEdit").val(data.kelurahan_name);
                }

            });
        });

        $(document).on('click','.editSubmit',function(){
            const editForm = $('#editForm');

            editForm.validate({
                errorClass: 'validation-invalid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });

            if(editForm.valid()){
                const kelurahanNameEdit = $('#kelurahanNameEdit').val();
                const alamat = $('#editForm').attr('action');
                $.ajax({
                    url : alamat,
                    type: 'POST',
                    data: {
                        kelurahanName:kelurahanNameEdit,
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
                    success:function(response){
                        $('#modal_form_vertical_edit').modal('hide');
                        $("#table").DataTable().ajax.reload();
                        swalInit({
                            type: 'success',
                            title : response,
                        });
                    },
                    error: function(xhr){
                        swalInit({
                            type: 'error',
                            title : xhr.responseText,
                        });
                    }
                })
            }
        })

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('kelurahan.destroy',':id') }}';
            alamat = alamat.replace(':id',id);

            swalInit({
                title: 'Apakah anda yakin ingin menghapus data ini ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                if (result.value) {
                    $.ajax({
                        url : alamat,
                        type: 'POST',
                        data: {
                            _token:'{{ csrf_token() }}',
                            _method: 'Delete'
                        },
                        success: function(response){
                            $("#table").DataTable().ajax.reload();
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error: function(xhr){
                            swalInit({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
                    })
                }
            })
        })
	</script>
@endsection
