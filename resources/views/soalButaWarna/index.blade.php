@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Pemeriksaan Buta Warna - Soal Buta Warna</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/pemeriksaanBw') }}" class="breadcrumb-item">Pemeriksaan Buta Warna</a>
		        		<span class="breadcrumb-item active">Soal buta warna</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
        	<button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical">Tambah soal buta warna</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Deskripsi</th>
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
                    <h5 class="modal-title">Tambah Soal Buta Warna</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="createForm" action="{{ route('soalButaWarna.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" placeholder="Silahkan masukan deskripsi soal" class="form-control" name="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label>Jawaban</label>
                            <input type="number" placeholder="Silahkan masukan jawaban soal" class="form-control" name="jawaban" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar Soal</label>
                            <input type="file" id="createImage" accept="image/*" placeholder="Silahkan masukan deskripsi soal" class="form-control" name="gambar" required>
                            <img id="createPrev" src="" height="" width="" style="visibility: none">
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
                    <h5 class="modal-title">Edit Soal Buta Warna</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" placeholder="Silahkan masukan deskripsi soal" class="form-control" name="deskripsiEdit" required>
                        </div>
                        <div class="form-group">
                            <label>Jawaban</label>
                            <input type="number" placeholder="Silahkan masukan jawaban soal" class="form-control" name="jawabanEdit" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar Soal</label>
                            <input id="gambarEdit" type="file" accept="image/*" placeholder="Silahkan masukan deskripsi soal" class="form-control gambarEdit" name="gambarEdit">
                            <span class="form-text text-muted">Accepted formats:png, jpg. Max file size 2Mb</span>
                            <img id="obatImg" src="" height="200px" width="200px">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <a type="button" class="btn bg-primary editSubmit">Submit form</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /vertical form modal -->
@endsection
@section('librariesJS')
    <script type="text/javascript" src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
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
                "ajax": {'url':"{{ url('soalButaWarnaAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'soal_buta_warna_id',name:'soal_buta_warna_id'},
                    {data: 'image', name: 'image'},
                    {data: 'deskripsi', name:'deskripsi'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

            function imgPreview(input){
                if(input.files && input.files[0]){
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('#obatImg').attr('src',e.target.result);
                        $('#obatImg').css('visibility','visible');
                        $('#obatImg').attr('width','150px');
                        $('#obatImg').attr('height','150px');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('.gambarEdit').change(function(){
                imgPreview(this);
            });

            const createPrev = (input) => {
                if(input.files &&input.files[0]){
                    let reader = new FileReader();

                    reader.onload = (e) => {
                        $('#createPrev').attr('src',e.target.result);
                        $('#createPrev').css('visibility','visible');
                        $('#createPrev').attr('width','200px');
                        $('#createPrev').attr('height','200px');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#createImage').on('change', function(){
                createPrev(this);
            })

        });

        $(document).on('click','.submit',function(){
            const createForm = $('#createForm');
            createForm.validate({
                errorClass: 'validation-invalid-label',
                errorPlacement: function(error,element){
                    error.appendTo(element.parents('.form-group'));
                },
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });

            if(createForm.valid()){
                const alamat = $('#createForm').attr('action');
                const deskripsi = $('input[name="deskripsi"]').val();
                const jawabanBenar = $('input[name="jawaban"]').val();
                let fd = new FormData();
                const files = $('input[name="gambar"]')[0].files[0];
                console.log(files);
                fd.append('file',files);
                fd.append('deskripsi',deskripsi);
                fd.append('jawabanBenar',jawabanBenar);
                $.ajax({
                    url : alamat,
                    method : 'POST',
                    processData:false,
                    contentType:false,
                    data: fd,
                    success:function(response){
                        $('#createForm')[0].reset();
                        $('#createPrev').css('visibility','none');
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
            let editUrl = '{{ route('soalButaWarna.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('soalButaWarna.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            $.ajax({
                url : editUrl,
                headers : "{{ csrf_token() }}",
                method : 'get',
                success : function(data){
                    $('#editForm').attr('action',updateUrl);
                    $('input[name="deskripsiEdit"]').val(data.deskripsi);
                    $('input[name="jawabanEdit"]').val(data.jawaban_benar);
                    $('#obatImg').attr('src',data.image);
                    $('#modal_form_vertical_edit').modal('show');
                }
            });
        });

        $(document).on('click','.editSubmit',function(){
            const editForm = $('#editForm');
            editForm.validate({
                errorClass: 'validation-invalid-label',
                errorPlacement: function(error,element){
                    error.appendTo(element.parents('.form-group'));
                },
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });

            if(editForm.valid()){
                const alamat = $('#editForm').attr('action');
                const deskripsi = $('input[name="deskripsiEdit"]').val();
                const jawabanBenar = $('input[name="jawabanEdit"]').val();
                let fd = new FormData();
                const files = $('input[name="gambarEdit"]')[0].files[0];
                fd.append('file',files);
                fd.append('deskripsi',deskripsi);
                fd.append('jawabanBenar',jawabanBenar);
                fd.append('_method','PUT');
                $.ajax({
                    url : alamat,
                    type: 'POST',
                    processData:false,
                    contentType:false,
                    data: fd,
                    success:function(response){
                        $('#editForm')[0].reset();
                        $('#modal_form_vertical_edit').modal('hide');
                        $("#table").DataTable().ajax.reload();
                        swalInit({
                            type: 'success',
                            title : response,
                        });
                    },
                    error: function(xhr){
                        swalInit({
                            type: 'success',
                            title : xhr.responseText,
                        });
                    }
                })
            }
        })

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('soalButaWarna.destroy',':id') }}';
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
