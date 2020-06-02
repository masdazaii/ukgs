@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - <span class="font-weight-semibold">{{ $kelas->sekolah->sekolah_name }}</span> - <span class="font-weight-semibold">Kelas {{ $kelas->kelas_name }}</span> - Siswa</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/sekolah') }}" class="breadcrumb-item"> Sekolah</a>
                        <a href="{{ URL::to('sekolah/'.$kelas->sekolah_id.'/kelas') }}" class="breadcrumb-item"> Kelas</a>
		        		<span class="breadcrumb-item active">Siswa</span>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical_create">Tambah siswa baru</button>
                    </div>      
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-right">
                                <button id="naikKelas" class="btn btn-warning" disabled data-toggle="modal" data-target="#modal_mini"><i class="icon-move-up mr-2"></i>Naik Kelas</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-left">
                                <button id="excel" class="btn btn-success"><i class="far fa-file-excel mr-2"></i>Tambah siswa dengan excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="excelForm" class="card mt-3" style="display: none;">
                <div class="card-header">
                    <p class="font-weight-semibold">Upload file excel disini</p>
                </div>
                <div class="card-body">
                    <form action="{{ url('importExcelSiswa') }}" class="dropzone" id="dropzone">@csrf</form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal_form_vertical_create" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input id="siswaName" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="siswaName" required>
                            <input type="hidden" name="kelasId" value="{{ $kelas->kelas_id }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>NIS (Nomor Iduk Siswa)</label>
                                <input type="text" placeholder="Silahkan masukan NIS siswa" class="form-control" name="nis" required>
                            </div>
                            <div class="col-md-8">
                                <label>NISN (Nomor Iduk Siswa Nasional)</label>
                                <input type="text" placeholder="Silahkan masukan NISN siswa" class="form-control" name="nisn" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3 mb-md-2">
                                <label class="d-block font-weight-semibold">Jenis Kelamin</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_unchecked" value="L" required>
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_unchecked">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_checked" value="P" required>
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_checked">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" placeholder="Silahkan masukan tempat lahir siswa" class="form-control" name="tempatLahir" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input type="date" class="form-control pickadate-selectors" placeholder="Try me&hellip;" name="tanggalLahir" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Agama</label>
                                <input type="text" placeholder="Silahkan masukan agama siswa" class="form-control" name="agama" required>
                            </div>
                            <div class="col-md-6">
                                <label>Nama Orang Tua</label>
                                <input type="text" placeholder="Silahkan masukan nama orang tua siswa" class="form-control" name="namaOrangTua" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" placeholder="Silahkan masukan alamat siswa" class="form-control" name="alamat" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-primary createSubmit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal_form_vertical_edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input id="siswaNameEdit" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="siswaName" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>NIS (Nomor Iduk Siswa)</label>
                                <input id="nis" type="text" placeholder="Silahkan masukan NIS siswa" class="form-control" name="nis" required>
                            </div>
                            <div class="col-md-8">
                                <label>NISN (Nomor Iduk Siswa Nasional)</label>
                                <input id="nisn" type="text" placeholder="Silahkan masukan NISN siswa" class="form-control" name="nisn" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3 mb-md-2">
                                <label class="d-block font-weight-semibold">Jenis Kelamin</label>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input id="jenisKelaminL" type="radio" class="form-check-input" name="jenisKelamin" value="L" required>
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input id="jenisKelaminP" type="radio" class="form-check-input" name="jenisKelamin" value="P" required>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input id="tempatLahir" type="text" placeholder="Silahkan masukan tempat lahir siswa" class="form-control" name="tempatLahir" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input id="tanggalLahir" type="date" class="form-control pickadate-selectors" placeholder="Try me&hellip;" name="tanggalLahir" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Agama</label>
                                <input id="agama" type="text" placeholder="Silahkan masukan agama siswa" class="form-control" name="agama" required>
                            </div>
                            <div class="col-md-6">
                                <label>Nama Orang Tua</label>
                                <input id="namaOrangTua" type="text" placeholder="Silahkan masukan nama orang tua siswa" class="form-control" name="namaOrangTua" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input id="alamat" type="text" placeholder="Silahkan masukan alamat siswa" class="form-control" name="alamat" required>
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

    <!-- Mini modal -->
    <div id="modal_mini" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih kelas tujuan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">Single select</label>
                        <div class="col-lg-9">
                            <select id="kelasTersedia" class="form-control">
                                <option>Silahkan pilih kelas tujuan</option>
                                @for($i = 0 ;$i < count($existingKelas) ;$i++)
                                    <option value="{{ $existingKelas[$i]->kelas_id }}"> {{ $existingKelas[$i]->kelas_name }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button id="naikKelasSubmit" type="button" class="btn bg-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /mini modal -->
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
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
            let selected = [];
            console.log("cek ready");
            $("#table").DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {'url':"{{ url('sekolah/'.$kelas->sekolah_id.'/kelas/'.$kelas->kelas_id.'/siswaAjax') }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'check',name:'check'},
                    {data: 'nis',name:'nis'},
                    {data: 'nisn', name:'nisn'},
                    {data: 'kelas_id',name:'kelas_id'},
                    {data: 'nama', name: 'nama'},
                    {data: 'jenis_kelamin',name:'jenis_kelamin'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
                "columnDefs": [
                    {
                        "orderable": false,
                        "className": 'select-checkbox',
                        "targets": 0
                    },
                ],
                "select": {
                    "style": 'os',
                    "selector": 'td:first-child'
                },
                "order": [[1, 'asc']]
            });

            $('#table tbody').on('click', '.select-checkbox', function () {
                let id = this.closest('tr').id;
                let index = $.inArray(id, selected);
         
                if ( index === -1 ) {
                    selected.push( id );
                } else {
                    selected.splice( index, 1 );
                }

                if(selected.length > 0){
                    $('#naikKelas').prop("disabled", false);
                }else{
                    $('#naikKelas').prop("disabled", true);
                }
         
                $(this).closest('tr').toggleClass('selected');
                console.log(selected);
            });

            $('#excel').on('click',function(){
                $('#excelForm').toggle();
            });

            $('#naikKelasSubmit').on('click',function(){
                const kelasTujuan = $('#kelasTersedia').val();
                $.ajax({
                    url :'{{ url('sekolah/'.$kelas->sekolah_id.'/kelas/'.$kelas->kelas_id.'/naikKelas') }}',
                    method : "POST",
                    data : {
                        selected : selected,
                        kelasTujuan : kelasTujuan,
                        _token : '{{ csrf_token() }}'
                    },
                    success: function(response){
                        $('#modal_mini').modal('hide');
                        $("#table").DataTable().ajax.reload();
                        swalInit({
                            type: 'success',
                            title : response
                        })
                    }
                })
            })

            $('.createSubmit').on('click',function(){
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

                if (createForm.valid()){
                    const request = $('#createForm').serialize();
                    $.ajax({
                        url: '{{ route('siswa.store') }}',
                        method: 'POST',
                        data: request,
                        success:function(response){
                            $("#table").DataTable().ajax.reload();
                            $('#modal_form_vertical_create').modal('hide');
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

                if (editForm.valid()){
                    const request = $('#editForm').serialize();
                    const alamat = $('#editForm').attr('action');
                    $.ajax({
                        url: alamat,
                        method: 'POST',
                        data: request,
                        success:function(response){
                            $("#table").DataTable().ajax.reload();
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
            url : '{{ url('importExcelSiswa') }}',
            params : {'kelasId':'{{ $kelas->kelas_id }}' },
            renameFile: function(file){
                var date = new Date();
                var time = date.getTime();
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
            error:function(xhr,status,error){
                swalInit({
                    type: 'error',
                    title : xhr.responseText,
                });
            }
        }

        $(document).on('click','.edit',function(){
            const id = $(this).data("id");
            let editUrl = '{{ route('siswa.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('siswa.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            $.ajax({
                url : editUrl,
                headers : {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                method : 'get',
                success : function(data){
                    $("#siswaNameEdit").val(data.nama);
                    $("#nis").val(data.nis);
                    $("#nisn").val(data.nisn);
                    $("#tempatLahir").val(data.tempat_lahir);
                    $("#tanggalLahir").val(data.tanggal_lahir);
                    if (data.jenis_kelamin == 'L') {
                        $("#jenisKelaminL").prop("checked",true);
                    } else {
                        $("#jenisKelaminP").prop("checked",true);
                    }
                    $("#agama").val(data.agama);
                    $("#namaOrangTua").val(data.nama_orang_tua);
                    $("#alamat").val(data.alamat);
                    $("#editForm").attr('action',updateUrl);
                    $("#modal_form_vertical_edit").modal('show');
                }
            });
        });

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('siswa.destroy',':id') }}';
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
