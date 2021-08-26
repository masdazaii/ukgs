@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kustomisasi logo</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Kustomisasi logo</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-header">
            <button class="btn btn-primary add-image">Tambah logo baru</button>
            <div id="imageForm" class="card mt-3" style="display: none;">
                <form id="createForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <p class="font-weight-semibold">Upload kustom logo</p>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Nama paket Image</label>
                            <input type="text" id="namaPaket" class="form-control" name="namaPaket" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label">Login logo</label>
                                <input type="file" id="loginLogo" name="loginLogo" accept="image/*" required>
                                <img id="loginPrev" src="">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Panel logo</label>
                                <input type="file" id="panelLogo" name="panelLogo" accept="image/*" required>
                                <img id="panelPrev" src="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="submit" class="btn bg-primary submit">Submit form</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th width="25%">Logo login</th>
                            <th>Logo panel</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
                            <input id="kelurahanNameEdit" type="text" placeholder="Silahkan masukan nama kelurahan" class="form-control" name="kelurahanName">
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
                "ajax": {'url':"{{ url('kustomGambarAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'nama_paket', name: 'nama_paket'},
                    {data: 'logo_login', name: 'logo_login'},
                    {data: 'logo_panel',nama:'logo_panel'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

            $('.add-image').on('click',function(){
                $('#imageForm').toggle();
            });

            function loginPreview(input){
                if(input.files && input.files[0]){
                    let reader = new FileReader();
                    reader.onload =  (e) => {
                        $('#loginPrev').attr('src',e.target.result);
                        $('#loginPrev').css('visibility','visible');
                        $('#loginPrev').attr('width','500px');
                        $('#loginPrev').attr('height','300px');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function panelPreview(input){
                if(input.files && input.files[0]){
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#panelPrev').attr('src',e.target.result);
                        $('#panelPrev').css('visibility','visible');
                        $('#panelPrev').attr('width','500px');
                        $('#panelPrev').attr('height','300px');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#loginLogo').on('change',function(){
                loginPreview(this);
            });

            $('#panelLogo').on('change',function(){
                panelPreview(this);
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
                const panelLogo = $('#panelLogo')[0].files[0];
                const loginLogo = $('#loginLogo')[0].files[0];
                const namaPaket = $('#namaPaket').val();
                let fd = new FormData();
                fd.append('panelLogo',panelLogo);
                fd.append('loginLogo',loginLogo);
                fd.append('namaPaket',namaPaket);
                $.ajax({
                    url : '{{ route('logo.store') }}',
                    method : 'POST',
                    processData:false,
                    contentType: false,
                    data: fd,
                    success:function(response){
                        $('#imageForm').toggle();
                        $("#createForm")[0].reset();
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

        $(document).on('click','.manage',function(){
            const id = $(this).data("id");
            console.log(id);
            let alamat = '{{ route('manage',':id') }}';
            alamat = alamat.replace(':id',id);
            $.ajax({
                url : alamat,
                type : 'POST',
                data: {id:id},
                success : function(data){
                    $("#table").DataTable().ajax.reload();
                    swalInit({
                        type: 'success',
                        title : 'logo login dan panel pada sistem telah diperbarui',
                    });
                },
                error: function(){
                    swalInit({
                        type: 'error',
                        title : 'terjadi kesalahan, silahkan hubungi pengembang',
                    });
                }

            });
        });



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
