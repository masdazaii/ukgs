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
                    <div class="text-right">
                        <button id="excel" class="btn btn-success"><i class="far fa-file-excel mr-2"></i>Tambah siswa dengan excel</button>
                    </div>
                </div>
            </div>
            <div id="excelForm" class="card mt-3" style="display: none;">
                <div class="card-header">
                    <p class="font-weight-semibold">Single file upload example:</p>
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
                            <th>id</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Sekolah</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th width="15%">Action</th>
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

                <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input id="siswaName" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="siswaName">
                            <input type="hidden" name="sekolahId" value="{{ $kelas->sekolah_id }}">
                            <input type="hidden" name="kelasId" value="{{ $kelas->kelas_id }}">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>NIS (Nomor Iduk Siswa)</label>
                                <input type="text" placeholder="Silahkan masukan NIS siswa" class="form-control" name="nis">
                            </div>
                            <div class="col-md-8">
                                <label>NISN (Nomor Iduk Siswa Nasional)</label>
                                <input type="text" placeholder="Silahkan masukan NISN siswa" class="form-control" name="nisn">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3 mb-md-2">
                                <label class="d-block font-weight-semibold">Jenis Kelamin</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_unchecked" value="L">
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_unchecked">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_checked" value="P">
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_checked">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" placeholder="Silahkan masukan tempat lahir siswa" class="form-control" name="tempatLahir">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input type="date" class="form-control pickadate-selectors" placeholder="Try me&hellip;" name="tanggalLahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Agama</label>
                                <input type="text" placeholder="Silahkan masukan agama siswa" class="form-control" name="agama">
                            </div>
                            <div class="col-md-6">
                                <label>Nama Orang Tua</label>
                                <input type="text" placeholder="Silahkan masukan nama orang tua siswa" class="form-control" name="namaOrangTua">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" placeholder="Silahkan masukan alamat siswa" class="form-control" name="alamat">
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
                            <input id="siswaNameEdit" type="text" placeholder="Silahkan masukan nama kelas" class="form-control" name="siswaName">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>NIS (Nomor Iduk Siswa)</label>
                                <input id="nis" type="text" placeholder="Silahkan masukan NIS siswa" class="form-control" name="nis">
                            </div>
                            <div class="col-md-8">
                                <label>NISN (Nomor Iduk Siswa Nasional)</label>
                                <input id="nisn" type="text" placeholder="Silahkan masukan NISN siswa" class="form-control" name="nisn">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3 mb-md-2">
                                <label class="d-block font-weight-semibold">Jenis Kelamin</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input id="jenisKelaminL" type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_unchecked" value="L">
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_unchecked">Laki-laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input id="jenisKelaminP" type="radio" class="custom-control-input" name="jenisKelamin" id="custom_radio_inline_checked" value="P">
                                    <label class="custom-control-label form-check-input-styled-primary" for="custom_radio_inline_checked">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input id="tempatLahir" type="text" placeholder="Silahkan masukan tempat lahir siswa" class="form-control" name="tempatLahir">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar5"></i></span>
                                </span>
                                <input id="tanggalLahir" type="date" class="form-control pickadate-selectors" placeholder="Try me&hellip;" name="tanggalLahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Agama</label>
                                <input id="agama" type="text" placeholder="Silahkan masukan agama siswa" class="form-control" name="agama">
                            </div>
                            <div class="col-md-6">
                                <label>Nama Orang Tua</label>
                                <input id="namaOrangTua" type="text" placeholder="Silahkan masukan nama orang tua siswa" class="form-control" name="namaOrangTua">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input id="alamat" type="text" placeholder="Silahkan masukan alamat siswa" class="form-control" name="alamat">
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
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/components_dropdowns.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/uploader_dropzone.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
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
                    {data: 'siswa_id', name:'siswa_id'},
                    {data: 'nis',name:'nis'},
                    {data: 'nisn', name:'nisn'},
                    {data: 'sekolah_id', name: 'sekolah_id'},
                    {data: 'kelas_id',name:'kelas_id'},
                    {data: 'nama', name: 'nama'},
                    {data: 'jenis_kelamin',name:'jenis_kelamin'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

            $('#excel').on('click',function(){
                $('#excelForm').toggle();
            });
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
                console.log(response);
                $('#excelForm').toggle();
                Swal.fire({
                    type: 'success',
                    title : 'Data dalam excel berhasil ditambahkan',
                });
            }
        }

        $(document).on('click','.edit',function(){
            var id = $(this).data("id");
            var url = '{{ route('siswa.update',':id') }}';
            url = url.replace(':id',id);
            $.ajax({
                url : "{{ url('siswaEditAjax') }}",
                headers : "{{ csrf_token() }}",
                method : 'get',
                data: {id:id},
                success : function(data){
                    console.log(data);
                    $("#siswaNameEdit").val(data.nama);
                    $("#nis").val(data.nis);
                    $("#nisn").val(data.nisn);
                    $("#tempatLahir").val(data.tempat_lahir);
                    $("#tanggalLahir").val(data.tanggal_lahir);
                    if (data.jenis_kelamin == 'L') {
                        $("#jenisKelaminL").attr("checked","checked");
                    } else {
                        $("#jenisKelaminP").attr("checked","checked");
                    }
                    $("#agama").val(data.agama);
                    $("#namaOrangTua").val(data.nama_orang_tua);
                    $("#alamat").val(data.alamat);
                    $("#editForm").attr('action',url);
                    $("#modal_form_vertical_edit").modal('show');
                }
            });
        });

        $(document).on('click','.delete',function(){
            var id = $(this).data("id");
            var alamat = '{{ route('siswa.destroy',':id') }}';
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