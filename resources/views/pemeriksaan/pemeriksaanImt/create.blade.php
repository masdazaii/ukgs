@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Pemeriksaan IMT</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Pemeriksaan IMT</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-body">
            <h4><span class="font-weight-semibold">Hasil Pemeriksaan IMT {{ $sekolah->sekolah_name }}</span></h4>
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th width="25%">Nama</th>
                            <th width="10%">Pemeriksa</th>
                            <th width="15%">Tinggi badan</th>
                            <th width="15%">Berat badan</th>
                            <th>Kategori</th>
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
                                <select id="pilihSiswa" class="form-control" name="pilihSiswa" >
                                    <option value="default">Silahkan pilih siswa</option>
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
                        <input id="sekolah" type="text" class="form-control col-sm-10" readonly value="">
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Kelas</label>
                        <input id="kelas" type="text" class="form-control col-sm-10" readonly value="">
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Nama</label>
                        <input id="nama" type="text" class="form-control col-sm-10" readonly value="">
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Jenis kelamin</label>
                        <input id="jenisKelamin" type="text" class="form-control col-sm-10" readonly value="">
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Usia</label>
                        <input id="usia" type="text" class="form-control col-sm-10" name="usia" readonly value="">
                    </div>
                    <div class="form-group row col-md-12">
                        <label class="col-form-label col-sm-2">Alamat</label>
                        <input id="alamat" type="text" class="form-control col-sm-10" readonly value="">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title"><span class="font-weight-semibold text-uppercase">Indeks Massa Tubuh</span></h6>
        </div>
        <div class="card-body">
            <form id="imtForm" action="">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Berat badan</label>
                        <input type="number" placeholder="masukan berat badan" class="form-control bb" name="beratBadan" required>
                    </div>
                    <div class="col-md-6">
                        <label>Tinggi Badan</label>
                        <input type="number" placeholder="masukan berat badan" class="form-control tb" name="tinggiBadan" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sangat_kurus" name="unstyled-radio-left" disabled>
                            Sangat Kurus
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input kurus" name="unstyled-radio-left"  disabled>
                            Kurus
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input normal" name="unstyled-radio-left" disabled>
                            Normal
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input gemuk" name="unstyled-radio-left" disabled>
                            Gemuk
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input sangat_gemuk" name="unstyled-radio-left" disabled>
                            Sangat gemuk
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="d-block ">Pernah divaksin</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="vaksin" value="0" required>
                            Belum
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="vaksin" value="1" required>
                            Sudah
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="d-block ">Rujukan</label>
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
                    <label class="form-check-label">Deskripsi</label>
                    <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Default textarea"></textarea>
                    <span class="form-text text-muted">Isikan deskripsi ketika siswa perlu dirujuk</span>
                </div>
                <div class="text-right">
                    <a type="button" class="btn btn-secondary" href="{{ URL::to('/pemeriksaanImt') }}">Back</a>
                    <button id="pemeriksaanImtSubmit" type="button" class="btn bg-primary">Submit form</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal_form_vertical_edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit pemeriksaan IMT</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="editForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Berat badan</label>
                                <input type="number" placeholder="masukan berat badan" class="form-control bbEdit" name="beratBadan" required>
                            </div>
                            <div class="col-md-6">
                                <label>Tinggi Badan</label>
                                <input type="number" placeholder="masukan berat badan" class="form-control tbEdit" name="tinggiBadan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input sangat_kurus_edit" name="unstyled-radio-left-edit" disabled>
                                    Sangat Kurus
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input kurus_edit" name="unstyled-radio-left-edit"  disabled>
                                    Kurus
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input normal_edit" name="unstyled-radio-left-edit" disabled>
                                    Normal
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input gemuk_edit" name="unstyled-radio-left-edit" disabled>
                                    Gemuk
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input sangat_gemuk_edit" name="unstyled-radio-left-edit" disabled>
                                    Sangat gemuk
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block ">Pernah vaksin</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="vaksinEdit" value="0" required>
                                    Belum
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="vaksinEdit" value="1" required>
                                    Sudah
                                </label>
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

    <div id="modal_form_vertical_show" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pemeriksaan IMT</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NIS</th>
                                <th width="25%" class="text-center">Nama Siswa</th>
                                <th class="text-center">Usia (tahun)</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th width="25%" class="text-center">Berat Badan *kg</th>
                                <th width="25%" class="text-center">Tinggi Badan *cm</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Rujukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="nis"></td>
                                <td id="namaSiswa"></td>
                                <td id="usiaSiswa"></td>
                                <td id="jenisKelaminSiswa"></td>
                                <td id="bbSiswa"></td>
                                <td id="tbSiswa"></td>
                                <td id="statusSiswa"></td>
                                <td id="rujukanSiswa"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right mt-2">
                        <label>Tanggal Pemeriksaan : </label><span id="tanggalPeriksa" class="badge badge-info"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                "ajax": {'url':"{{ url('detailPemeriksaanImtAjax',[$id,$sekolah->sekolah_id]) }}",
                        'headers':"{{ csrf_token() }}"},
                "dataSrc": "data",
                "columns": [
                    {data: 'siswa_id',name:'siswa_id'},
                    {data: 'pemeriksa_id',name: 'pemeriksa_id'},
                    {data: 'tinggi_badan', name: 'tinggi_badan'},
                    {data: 'berat_badan',name:'berat_badan'},
                    {data: 'kategori',name:'kategori'},
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
                        id:id
                    },
                    success : function(data){
                        $("#sekolah").val(data.kelas_mapping[0].kelas.sekolah.sekolah_name);
                        $("#kelas").val(data.kelas_mapping[0].kelas.kelas_name);
                        $("#nama").val(data.nama);
                        $("#jenisKelamin").val(data.jenis_kelamin);
                        $("#alamat").val(data.alamat);
                        $('#usia').val(data.usia);
                        siswaId = data.siswa_id;
                    }
                })
            });

            $('.tb, .bb').on('keyup',function(){
                const bb = $('.bb').val();
                const tb = $('.tb').val()/100;
                let imt = (bb/(tb*tb)).toFixed(1);
                const radioButton = $('input[name="unstyled-radio-left');

                if(imt < 17){
                    $('.sangat_kurus').prop('checked',true);
                }else if(imt >= 17 && imt <= 18.4 ){
                    $('.kurus').prop('checked',true);
                }else if(imt >= 18.5 && imt <= 25 ){
                    $('.normal').prop('checked',true);
                }else if(imt >= 25.1 && imt <= 27 ){
                    $('.gemuk').prop('checked',true);
                }else{
                    $('.sangat_gemuk').prop('checked',true);
                }

                for(let i=0;i < radioButton.length; i++){
                    if(!radioButton[i].checked)
                    {
                        this.checked = false;
                    }
                }
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

            const submitButton = document.querySelector('#pemeriksaanImtSubmit');
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
                const imtForm = $('#imtForm');
                imtForm.validate({
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

                if (siswaForm.valid() && imtForm.valid() && selVal != "default") {
                    const form = document.querySelector('#imtForm');
                    const bb = document.querySelector(".bb").value;
                    const tb = document.querySelector(".tb").value;
                    const rbRujukan = document.getElementsByName('rujukan');
                    let rujukan = null;
                    if(rbRujukan[0].checked){
                        rujukan = rbRujukan[0].value;
                    }else{
                        rujukan = rbRujukan[1].value;
                    };
                    const rbVaksin = document.getElementsByName('vaksin');
                    let vaksin = null;
                    if(rbVaksin[0].checked){
                        vaksin = rbVaksin[0].value;
                    }else{
                        vaksin = rbVaksin[1].value;
                    };
                    const deskripsi = document.getElementById('deskripsi');
                    const alamat = form.getAttribute('action');
                    $.ajax({
                        url : '{{ route('pemeriksaanImt.store') }}',
                        method : 'POST',
                        data : {
                            bb:bb,
                            tb:tb,
                            rujukan:rujukan,
                            vaksin:vaksin,
                            deskripsi:deskripsi.value,
                            jenisPemeriksaan: {{ $id }},
                            siswaId: siswaId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            $("#pilihSiswa option").remove();
                            $("#imtForm")[0].reset();
                            $("#detailForm")[0].reset();
                            $("#siswaForm")[0].reset();
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

            $('.tbEdit, .bbEdit').on('keyup',function(){
                const bb = $('.bbEdit').val();
                const tb = $('.tbEdit').val()/100;
                let imt = (bb/(tb*tb)).toFixed(1);
                console.log(imt);
                const radioButton = $('input[name="unstyled-radio-left-edit');

                if(imt < 17){
                    $('.sangat_kurus_edit').prop('checked',true);
                }else if(imt >= 17 && imt <= 18.4 ){
                    $('.kurus_edit').prop('checked',true);
                }else if(imt >= 18.5 && imt <= 25 ){
                    $('.normal_edit').prop('checked',true);
                }else if(imt >= 25.1 && imt <= 27 ){
                    $('.gemuk_edit').prop('checked',true);
                }else{
                    $('.sangat_gemuk_edit').prop('checked',true);
                }

                for(let i=0;i < radioButton.length; i++){
                    if(!radioButton[i].checked)
                    {
                        this.checked = false;
                    }
                }
            });
        });

        $(document).on('click','.edit',function(){
            const id = $(this).data("id");
            let editUrl = '{{ route('pemeriksaanImt.edit',':id') }}';
            editUrl = editUrl.replace(':id',id);
            let updateUrl = '{{ route('pemeriksaanImt.update',':id') }}';
            updateUrl = updateUrl.replace(':id',id);
            $.ajax({
                url : editUrl,
                headers : "{{ csrf_token() }}",
                method : '',
                data: {id: id},
                success : function(data){
                    $('#editForm').attr('action',updateUrl);
                    const tb = data.detail_pemeriksaan_imt.tinggi_badan;
                    const bb = data.detail_pemeriksaan_imt.berat_badan;
                    const rujukan = data.rujukan;
                    const vaksin = data.detail_pemeriksaan_imt.vaksin;
                    let textarea = document.getElementById('deskripsiEdit');
                    $('.bbEdit').val(bb);
                    $('.tbEdit').val(tb);

                    const imt =  bb/(Math.pow(tb/100,2));
                    const radioButton = $('input[name="unstyled-radio-left-edit');

                    if(imt < 17){
                        $('.sangat_kurus_edit').prop('checked',true);
                    }else if(imt >= 17 && imt <= 18.4 ){
                        $('.kurus_edit').prop('checked',true);
                    }else if(imt >= 18.5 && imt <= 25 ){
                        $('.normal_edit').prop('checked',true);
                    }else if(imt >= 25.1 && imt <= 27 ){
                        $('.gemuk_edit').prop('checked',true);
                    }else{
                        $('.sangat_gemuk_edit').prop('checked',true);
                    }

                    let rbRujukan = document.getElementsByName("rujukanEdit");
                    if (rujukan == false) {
                        rbRujukan[0].checked= true;
                    }else{
                        rbRujukan[1].checked= true;
                    }

                    let rbVaksin = document.getElementsByName("vaksinEdit");
                    if (vaksin == false) {
                        rbVaksin[0].checked= true;
                    }else{
                        rbVaksin[1].checked= true;
                    }

                    if(data.rujukan == 1){
                        textarea.value = data.detail_rujukan.deskripsi;
                    }else{
                        textarea.value = textarea.defaultValue;
                    }

                    $('#modal_form_vertical_edit').modal('show');
                }

            });
        });

        $(document).on('click','.detail',function(){
            const pemeriksaanId = $(this).data("idpemeriksaanimt");
            let alamat = '{{ route('pemeriksaanImt.show',':id') }}';
            alamat = alamat.replace(':id',pemeriksaanId);
            $.ajax({
                url : alamat,
                type: 'GET',
                success : function(response){
                    document.getElementById('namaSiswa').innerText = response.siswa.nama;
                    document.getElementById('nis').innerText = response.siswa.nis;
                    document.getElementById('usiaSiswa').innerText = response.siswa.usia;
                    document.getElementById('jenisKelaminSiswa').innerText = response.siswa.jenis_kelamin;
                    document.getElementById('bbSiswa').innerText = response.detail_pemeriksaan_imt.berat_badan;
                    document.getElementById('tbSiswa').innerText = response.detail_pemeriksaan_imt.tinggi_badan;
                    let statusSiswa =  document.getElementById('statusSiswa');
                    const statusValue = response.detail_pemeriksaan_imt.berat_badan/(Math.pow(response.detail_pemeriksaan_imt.tinggi_badan/100,2));

                    if(statusValue < 17){
                        statusSiswa.innerText = "sangat kurus";
                    }else if(statusValue >= 17 && statusValue <= 18.4 ){
                        statusSiswa.innerText = "kurus";
                    }else if(statusValue >= 18.5 && statusValue <= 25 ){
                        statusSiswa.innerText = "normal";
                    }else if(statusValue >= 25.1 && statusValue <= 27 ){
                        statusSiswa.innerText = "gemuk";
                    }else{
                        statusSiswa.innerText = "sangat gemuk";
                    }

                    let rujukan = document.getElementById('rujukanSiswa');
                    if (response.rujukan == 1) {
                        rujukan.innerText = "Perlu dirujuk"
                    }else{
                        rujukan.innerText = "Tidak dirujuk"
                    }

                    let tanggalPemeriksaan = document.getElementById('tanggalPeriksa');
                    tanggalPeriksa.innerText = response.created_at.toLocaleString();

                    $('#modal_form_vertical_show').modal('show');
                },
                error:function(xhr,status,error){
                    Swal.fire({
                        type: 'error',
                        title : xhr.responseText,
                    });
                }
            })
        })

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
            if (editForm.valid()) {
                const bb = $('.bbEdit').val();
                const tb = $('.tbEdit').val();
                const alamat = $('#editForm').attr('action');
                const rbRujukan = document.getElementsByName('rujukanEdit');
                const deskripsi = document.getElementById('deskripsiEdit');
                let rujukan = null;
                if(rbRujukan[0].checked){
                    rujukan = rbRujukan[0].value;
                }else{
                    rujukan = rbRujukan[1].value;
                };
                const rbVaksin = document.getElementsByName('vaksinEdit');
                let vaksin = null;
                if(rbVaksin[0].checked){
                    vaksin = rbVaksin[0].value;
                }else{
                    vaksin = rbVaksin[1].value;
                };
                $.ajax({
                    url : alamat,
                    type: 'POST',
                    data: {
                        bb:bb,
                        tb:tb,
                        rujukan:rujukan,
                        vaksin:vaksin,
                        deskripsi:deskripsi.value,
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
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
        })

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('pemeriksaanImt.destroy',':id') }}';
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
