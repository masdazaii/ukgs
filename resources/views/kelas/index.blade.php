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
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-left">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical">Tambah kelas baru</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <button id="excel" class="btn btn-success"><i class="icon-file-excel mr-1"></i>Input Kelas dengan excel</button>
                    </div>
                </div>
            </div>
            <div id="excelForm" class="card mt-3" style="display: none;">
                <div class="card-header">
                    <p class="font-weight-semibold">Upload file excel disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ url('importExcelKelas') }}" class="dropzone" id="dropzone">@csrf</form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th width="30%">Action</th>
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

                <form id="createForm" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input id="kelasName" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="kelasName" required>
                            <input type="hidden" name="sekolahId" value="{{ $sekolah->sekolah_id }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-primary storeSubmit">Submit form</button>
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
                    <h5 class="modal-title">Edit Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input id="kelasNameEdit" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="kelasName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-primary editSubmit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
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

            $('#excel').on('click',function(){
                $('#excelForm').toggle();
            });

            $('.storeSubmit').on('click',function(){
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
                    const request = $('#createForm').serialize();
                    $.ajax({
                        url: '{{ route('kelas.store') }}',
                        method: 'POST',
                        data: request,
                        success:function(response){
                            createForm[0].reset();
                            $("#table").DataTable().ajax.reload();
                            $('#modal_form_vertical').modal('hide');
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
                            swalInit({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
                    })
                }
            })

            $('.editSubmit').on('click',function(){
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
                    const request = $('#editForm').serialize();
                    const alamat = $('#editForm').attr('action');
                    $.ajax({
                        url: alamat,
                        method: 'POST',
                        data: request,
                        success:function(response){
                            $("#table").DataTable().ajax.reload(null,false);
                            $('#modal_form_vertical_edit').modal('hide');
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
                            swalInit({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
                    })
                }
            })
        });

        Dropzone.options.dropzone = {
            url : '{{ url('importExcelKelas') }}',
            params : {'sekolahId':'{{ $sekolah->sekolah_id }}' },
            renameFile: function(file){
                const date = new Date();
                const time = date.getTime();
                return time+file.name;
            },
            acceptedFiles: ".xls,.xlsx",
            success : function(file,response){
                $("#table").DataTable().ajax.reload();
                $('#excelForm').toggle();
                swalInit({
                    type: 'success',
                    title : response,
                });
            },
            error: function(){
                swalInit({
                    type: 'error',
                    title : "terdapat kesalahan, pastikan file telah sesuai dengan ketentuan",
                });
            }
        }

        $(document).on('click','.edit',function(){
            const id = $(this).data("id");
            let editUrl = '{{ route('kelas.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('kelas.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            $.ajax({
                url : editUrl,
                headers : {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                method : 'get',
                success : function(data){
                    $("#kelasNameEdit").val(data.kelas_name);
                    $("#sekolahId").val(data.sekolah_id);
                    $("#editForm").attr('action',updateUrl);
                    $("#modal_form_vertical_edit").modal('show');
                }

            });
        });

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('kelas.destroy',':id') }}';
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
                        headers:{
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        data: {
                            _method: 'Delete'
                        },
                        success: function(response){
                            $("#table").DataTable().ajax.reload(null,false);
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
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
