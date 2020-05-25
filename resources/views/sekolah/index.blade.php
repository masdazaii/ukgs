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
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Sekolah</span>
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
                        <a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_form_vertical_create"><i class="icon-plus22 mr-1"></i> Tambah data sekolah baru</a>
                    </div>      
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <button id="excel" class="btn btn-success"><i class="icon-file-excel mr-1"></i>Tambah sekolah dengan excel</button>
                    </div>
                </div>
            </div>
            <div id="excelForm" class="card mt-3" style="display: none;">
                <div class="card-header">
                    <p class="font-weight-semibold">Upload file excel disini </p>
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
                            <th class="text-center" width="5%">
                                ID
                            </th>
                            <th>NPSN</th>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Kecamatan</th>
                            <th>Kota Administrasi</th>
                            <th width="30%">Action</th>
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
                    <h5 class="modal-title">Tambah Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="createForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NPSN :</label>
                            <input type="number" class="form-control" placeholder="Silahkan masukan NPSN sekolah" minlength="8" maxlength="8" name="npsn" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah :</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <select id="sekolahSelect" class="form-control" name="sekolahType" required>
                                        <option value="SD">SD/MI</option>
                                        <option value="SMP">SMP/MTs</option>
                                        <option value="SMA">SMA/SMK/MA</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Silahkan masukan nama sekolah" name="sekolahName" required> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kelurahan :</label>
                            <select id="selectKelurahan" class="form-control" name="kelurahan" required>
                                <option>Pilih Kelurahan</option>
                                @for($i = 0;$i < count($kelurahan);$i++)
                                    <option value="{{ $kelurahan[$i]->kelurahan_id }}">{{ $kelurahan[$i]->kelurahan_name }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan alamat sekolah" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan :</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan kecamatan sekolah" name="kecamatan" required>
                        </div>
                        <div class="form-group">
                            <label>Kota Administrasi</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan kota administrasi sekolah" name="kotaAdministrasi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-primary submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal_form_vertical_edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="editForm" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NPSN :</label>
                            <input type="number" class="form-control" placeholder="Silahkan masukan NPSN sekolah" name="npsnEdit" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah :</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <select id="sekolahSelectEdit" class="form-control" name="sekolahTypeEdit" required>
                                        <option value="SD">SD/MI</option>
                                        <option value="SMP">SMP/MTs</option>
                                        <option value="SMA">SMA/SMK/MA</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Silahkan masukan nama sekolah" name="sekolahNameEdit" required> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kelurahan :</label>
                            <select id="selectKelurahanEdit" class="form-control" name="kelurahanEdit" required>
                                <option>Pilih Kelurahan</option>
                                @for($i = 0;$i < count($kelurahan);$i++)
                                    <option value="{{ $kelurahan[$i]->kelurahan_id }}">{{ $kelurahan[$i]->kelurahan_name }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan alamat sekolah" name="alamatEdit" required>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan :</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan kecamatan sekolah" name="kecamatanEdit" required>
                        </div>
                        <div class="form-group">
                            <label>Kota Administrasi</label>
                            <input type="text" class="form-control" placeholder="Silahkan masukan kota administrasi sekolah" name="kotaAdministrasiEdit" required>
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
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
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

            $('.submit').on('click',function(){
                const createform = $('#createForm');
                createform.validate({
                    errorClass: 'validation-invalid-label',
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    }
                });
                if (createform.valid()) {
                    const npsn = document.querySelector('input[name="npsn"]').value;
                    const selectSekolahType = document.getElementById('sekolahSelect');
                    const sekolahType = selectSekolahType.options[selectSekolahType.selectedIndex].value;
                    const sekolahName = document.querySelector('input[name="sekolahName"]').value;
                    const alamat = document.querySelector('input[name="alamat"]').value;
                    const selectKelurahan = document.getElementById('selectKelurahan');
                    const kelurahan = selectKelurahan.options[selectKelurahan.selectedIndex].value;
                    const kecamatan = document.querySelector('input[name="kecamatan"]').value;
                    const kotaAdministrasi = document.querySelector('input[name="kotaAdministrasi"]').value;
                    $.ajax({
                        url: '{{ route('sekolah.store') }}',
                        method:'POST',
                        headers:{
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        data:{
                            npsn,
                            sekolahType,
                            sekolahName,
                            alamat,
                            kelurahan,
                            kecamatan,
                            kotaAdministrasi
                        },
                        success:function(response){
                            $("#table").DataTable().ajax.reload();
                            $('#modal_form_vertical_create').modal('hide');
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
                            $('#modal_form_vertical_create').modal('hide');
                            swalInit({
                                type: 'error',
                                title : xhr.responseText,
                            });
                        }
                    });
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

                if (editForm.valid()) {
                    const alamat = $("#editForm").attr('action');
                    console.log(alamat);
                    const request = $(editForm).serialize();
                    $.ajax({
                        url: alamat,
                        method:'POST',
                        headers:{
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        data:request,
                        success:function(response){
                            console.log(response);
                            $("#table").DataTable().ajax.reload();
                            $('#modal_form_vertical_edit').modal('hide');
                            swalInit({
                                type: 'success',
                                title : response,
                            });
                        },
                        error:function(xhr,status,error){
                            $('#modal_form_vertical_edit').modal('hide');
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

        $(document).on('click','.edit',function(){
            const sekolahTypeOptions = document.getElementById('sekolahSelectEdit');
            const kelurahanOptions = document.getElementById('selectKelurahanEdit');
            const id = $(this).data("id");
            let editUrl = '{{ route('sekolah.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('sekolah.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            // console.log(editUrl);
            console.log(updateUrl);
            $.ajax({
                url: editUrl,
                method:'GET',
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                success:function(response){
                    for (let i = 0; i < sekolahTypeOptions.length; i++) {
                        if (sekolahTypeOptions.options[i].value == response.sekolah_type) 
                        {
                            sekolahTypeOptions.selectedIndex = i;
                            break;
                        }
                    }
                    // console.log(response.kelurahan);
                    for (let i = 0; i < kelurahanOptions.length; i++) {
                        if (kelurahanOptions.options[i].value == response.kelurahan.kelurahan_id) 
                        {
                            kelurahanOptions.selectedIndex = i;
                            break;
                        }
                    }

                    document.getElementsByName('npsnEdit')[0].value = response.npsn;
                    document.getElementsByName('sekolahNameEdit')[0].value = response.sekolah_name;
                    document.getElementsByName('kecamatanEdit')[0].value = response.kecamatan;
                    document.getElementsByName('alamatEdit')[0].value = response.alamat;
                    document.getElementsByName('kotaAdministrasiEdit')[0].value = response.kota_administrasi;
                    $('#editForm').attr('action',updateUrl);
                    $('#modal_form_vertical_edit').modal('show');
                }
            })
        })

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('sekolah.destroy',':id') }}';
            alamat = alamat.replace(':id',id);

            swalInit({
                title: 'Apakah anda yakin ingin menghapus data ini ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                if (result.value)
                {
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