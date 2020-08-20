@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Pemeriksaan Penyakit Tidak Menular</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/pemeriksaanPtm') }}" class="breadcrumb-item">Pemeriksaan Penyakit Tidak Menular</a>
		        		<span class="breadcrumb-item active">Create</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-body">
            <h4><span class="font-weight-semibold">Hasil Pemeriksaan Penyakit Tidak Menular {{ $sekolah->sekolah_name }}</span></h4>
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pemeriksa</th>
                            <th>Tekanan Darah</th>
                            <th>Lingkar Pinggang</th>
                            <th>Nilai Gula Darah Sewaktu</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <form id="siswaForm">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2" >Pilih kelas</label>
                            <div class="col-md-10">
                                <select id="pilihKelas" class="form-control" name="pilihKelas">
                                    <option>Silahkan pilih kelas yang akan diperiksa</option>
                                    @for($i=0; $i < count($kelas); $i++)
                                        <option value="{{ $kelas[$i]->kelas_id }}">{{ $kelas[$i]->kelas_name }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2" >Pilih siswa</label>
                            <div class="col-md-10">
                                <select id="pilihSiswa" class="form-control" name="pilihSiswa">
                                    <option value="default">Silahkan pilih siswa yang akan diperiksa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="detailForm">
                <div class="row d-flex">
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Sekolah</label>
                        <input id="sekolah" type="text" class="form-control col-sm-10" readonly>
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Kelas</label>
                        <input id="kelas" type="text" class="form-control col-sm-10" readonly>
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Nama</label>
                        <input id="nama" type="text" class="form-control col-sm-10" readonly>
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Jenis kelamin</label>
                        <input id="jenisKelamin" type="text" class="form-control col-sm-10" readonly>
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Usia</label>
                        <input id="usia" type="text" class="form-control col-sm-10" readonly>
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Alamat</label>
                        <input id="alamat" type="text" class="form-control col-sm-10" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4><span class="font-weight-semibold">Pemeriksaan Penyakit Tidak Menular</span></h4>
            <form id="ptmForm" action="">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="d-block font-weight-semibold">Tekanan Darah</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="number" placeholder="Sistolik" class="form-control" name="sistolik" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" placeholder="Diastolik" class="form-control" name="diastolik" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block font-weight-semibold">Lingkar Pinggang</label>
                        <input type="number" placeholder="Lingkar Pinggang" class="form-control" name="lingkarPinggang" required>
                    </div>
                    <div class="col-md-4">
                        <label class="d-block font-weight-semibold">Nilai gula darah sewaktu</label>
                        <input type="number" placeholder="Nilai Gula darah" class="form-control" name="gulaDarah" required>
                    </div>
                </div>
                <div class="form-group">
                   <label class="d-block font-weight-semibold">Rujukan</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="rujukan" value="0" required>
                            -
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="rujukan" value="1" required>
                            +
                        </label>
                    </div>
                </div>
                <div class="form-group">
                   <label class="d-block font-weight-semibold">Deskripsi</label>
                    <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Default textarea"></textarea>
                    <span class="form-text text-muted">Isikan deskripsi ketika siswa perlu dirujuk</span>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary">Back</button>
                    <button id="pemeriksaanPtmSubmit" type="button" class="btn bg-primary">Submit form</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal_form_vertical_edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit pemeriksaan sosial</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="d-block font-weight-semibold">Tekanan Darah</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input id="sistolikEdit" type="number" placeholder="Sistolik" class="form-control" name="sistolik" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="diastolikEdit" type="number" placeholder="Diastolik" class="form-control" name="diastolik" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block font-weight-semibold">Lingkar Pinggang</label>
                                <input id="lingkarPinggangEdit" type="number" placeholder="Lingkar Pinggang" class="form-control" name="lingkarPinggang" required>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block font-weight-semibold">Nilai gula darah sewaktu</label>
                                <input id="gulaDarahEdit" type="number" placeholder="Nilai Gula darah" class="form-control" name="gulaDarah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Rujukan</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rujukanEdit" value="0" required>
                                    -
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rujukanEdit" value="1" required>
                                    +
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label">Deskripsi</label>
                            <textarea id="deskripsiEdit" class="form-control" placeholder="Default textarea" readonly="readonly"></textarea>
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
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
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
                "ajax": {'url':"{{ url('detailPemeriksaanPtmAjax',[$id,$sekolah->sekolah_id]) }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'siswa_id',name:'siswa_id'},
                    {data:'pemeriksa_id',name:'pemeriksa_id'},
                    {data: 'tekanan_darah', name: 'tekanan_darah'},
                    {data: 'lingkar_pinggang',name:'lingkar_pinggang'},
                    {data: 'nilai_gula_darah_sewaktu',name:'nilai_gula_darah_sewaktu'},
                    {data: 'action', name: 'action', "orderable": false, "searchable": false}
                ],
                "fixedColumns": true,
            });

            $("#pilihKelas").on('change',function(){
                const id = $(this).val();
                const jenisPemeriksaan = {{ $id }};
                $('#pilihSiswa option').remove();
                $.ajax({
                    url:'{{ url('siswaByKelasAjax') }}',
                    method: 'GET',
                    data : {
                        pemeriksaan : jenisPemeriksaan,
                        id:id
                    },
                    success : function(response){
                        if(response.length > 0){
                            $('#pilihSiswa').append('<option value="default">Silahkan pilih siswa</option>')
                            for (let i = 0; i < response.length; i++) {
                                $('#pilihSiswa').append('<option value='+response[i].siswa.siswa_id+'>'+response[i].siswa.nama+'</option>')
                            }
                        }else{
                            $('#pilihSiswa').append('<option>Tidak terdapat siswa atau Semua siswa sudah diperiksa</option>')
                        }
                    }
                })
            })

            let siswaId = null;
            $("#pilihSiswa").on('change',function(){
                const id = $(this).val();
                $.ajax({
                    url: '{{ url('detailSiswa') }}',
                    method: 'GET',
                    data : {
                        id:id                   },
                    success : function(data){
                        $("#sekolah").val(data.kelas_mapping[0].kelas.sekolah.sekolah_name);
                        $("#kelas").val(data.kelas_mapping[0].kelas.kelas_name);
                        $("#nama").val(data.nama);
                        $("#jenisKelamin").val(data.jenis_kelamin);
                        $("#usia").val(data.usia);
                        $("#alamat").val(data.alamat);
                        siswaId = data.siswa_id;
                    }
                })
            });

            $('input[name="rujukan"]').on('change',function(){
                const val = $(this).val();
                if (val ==0) {
                    const deskripsi = document.getElementById('deskripsi');
                    deskripsi.value = deskripsi.defaultValue;
                    $('#deskripsi').prop('readonly',true);
                }else{
                    $('#deskripsi').prop('readonly',false);
                }
            })

            $('input[name="rujukanEdit"]').on('change',function(){
                const val = $(this).val();
                console.log(val);
                if (val ==0) {
                    let deskripsi = document.getElementById('deskripsiEdit');
                    deskripsi.value = deskripsi.defaultValue;
                    $('#deskripsiEdit').prop('readonly',true);
                }else{
                    $('#deskripsiEdit').prop('readonly',false);
                }
            })

            const submitButton = document.querySelector('#pemeriksaanPtmSubmit');
            submitButton.addEventListener('click',function(){
                const siswaForm = $('#siswaForm');
                siswaForm.validate({
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
                const ptmForm = $('#ptmForm');
                ptmForm.validate({
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

                const select = document.getElementById('pilihSiswa');
                const selVal = select.options[select.selectedIndex].value;
                if(selVal == "default"){
                    swalInit({
                        type: 'warning',
                        title : "Silahkan pilih kelas dan siswa yang akan diperiksa",
                    });
                }

                if (siswaForm.valid() && ptmForm.valid() && selVal != "default") {
                    const request = $('#ptmForm').serializeArray();
                    request.push({name:"jenisPemeriksaan", value:'{{ $id }}'});
                    request.push({name:"_token",value: document.querySelector('meta[name="csrf-token"]').content});
                    request.push({name: "siswaId",value: siswaId});
                    $.ajax({
                        url : '{{ route('pemeriksaanPtm.store') }}',
                        method : 'POST',
                        data :request,
                        success: function(response){
                            $("#pilihSiswa option").remove();
                            $("#table").DataTable().ajax.reload();
                            ptmForm[0].reset();
                            siswaForm[0].reset();
                            $("#detailForm")[0].reset();
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

        $(document).on('click','.edit',function(){
            const id = $(this).data("id");
            let editUrl = '{{ route('pemeriksaanPtm.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('pemeriksaanPtm.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            $.ajax({
                url : editUrl,
                headers : "{{ csrf_token() }}",
                method : '',
                data: {id: id},
                success : function(data){
                    console.log(data);
                    $('#editForm').attr('action',updateUrl);
                    $('#sistolikEdit').val(data.detail_pemeriksaan_ptm.tekanan_sistolik);
                    $('#diastolikEdit').val(data.detail_pemeriksaan_ptm.tekanan_diastolik);
                    $('#lingkarPinggangEdit').val(data.detail_pemeriksaan_ptm.lingkar_pinggang);
                    $('#gulaDarahEdit').val(data.detail_pemeriksaan_ptm.nilai_gula_darah_sewaktu);

                    const rujukan = data.rujukan;
                    let rbRujukan = document.getElementsByName("rujukanEdit");
                    if (rujukan == false) {
                        rbRujukan[0].checked= true;
                    }else{
                        rbRujukan[1].checked= true;
                    }

                    let textarea = document.getElementById('deskripsiEdit');
                    if(data.rujukan == 1){
                        textarea.value = data.detail_rujukan.deskripsi;
                        textarea.readOnly = false;
                    }else{
                        textarea.value = textarea.defaultValue;
                    }

                    $('#modal_form_vertical_edit').modal('show');
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
            if (editForm.valid()) {
                const request = $('#editForm').serializeArray();
                request.push({name:"deskripsi",value: document.getElementById('deskripsiEdit').value});
                request.push({name:"_method",value:"PUT"});
                const alamat = $('#editForm').attr('action');
                $.ajax({
                    url : alamat,
                    type: 'POST',
                    data:request,
                    success: function(response){
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
        });

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('pemeriksaanPtm.destroy',':id') }}';
            alamat = alamat.replace(':id',id);

            swalInit({
                title: 'Apakah anda yakin ingin menghapus data ini ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus data ini!'
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
