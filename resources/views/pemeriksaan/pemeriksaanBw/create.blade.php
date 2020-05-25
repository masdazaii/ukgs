@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Pemeriksaan Buta Warna</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/pemeriksaanBw') }}" class="breadcrumb-item">Pemeriksaan Buta Warna</a>
		        		<span class="breadcrumb-item active">create</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

	<div class="card">
        <div class="card-body">
            <h4><span class="font-weight-semibold">Hasil Pemeriksaan Buta Warna {{ $sekolah->sekolah_name }}</span></h4>
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pemeriksa</th>
                            <th>Status</th>
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
                                    <option>Silahkan pilih siswa yang akan diperiksa</option>                               
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
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Form Pemeriksaan Buta Warna</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <form id="bwForm" class="wizard-form steps-validation" action="#" data-fouc>
            @for($i = 0;$i < count($soalButaWarna); $i++)
                <h6>Soal ke-{{$i+1}}</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-8 text-center" style="margin: 0 auto; float: none;">
                            <!-- Zooming -->
                            <div class="card">
                                <input type="hidden" id="soal{{ $i }}" value="{{ $soalButaWarna[$i]->soal_buta_warna_id }}">
                                <div class="card-img-actions">
                                    <img class="card-img-top img-fluid" src="{{ '/'.$soalButaWarna[$i]->image }}">
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Deskripsi Soal</h5>
                                    <p class="card-text">{{ $soalButaWarna[$i]->deskripsi }}</p>
                                    <div class="form-group">
                                        <label>Jawaban<span class="text-danger">*</span></label>
                                        <input type="text" id="jawaban{{$i}}" class="form-control required">
                                    </div>
                                </div>
                            </div>
                            <!-- /zooming -->
                        </div>
                    </div>
                </fieldset>
            @endfor
        </form>
    </div>
    <!-- /wizard with validation -->

@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/content_cards_content.js') }}"></script>
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
                "ajax": {'url':"{{ url('detailPemeriksaanBwAjax',[$id,$sekolah->sekolah_id]) }}",
                        'headers':"{{ csrf_token() }}"},
                "order": ['0', 'desc'],
                "dataSrc": "data",
                "columns": [
                    {data: 'siswa_id',name:'siswa_id'},
                    {data:'pemeriksa_id',name:'pemeriksa_id'},
                    {data: 'status_buta_warna', name: 'status_buta_warna'},
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
                            $('#pilihSiswa').append('<option>Silahkan pilih siswa</option>')
                            for (let i = 0; i < response.length; i++) {
                                $('#pilihSiswa').append('<option value='+response[i].siswa.siswa_id+'>'+response[i].siswa.nama+'</option>')
                            }
                        }else{
                            $('#pilihSiswa').append('<option>Semua siswa di kelas ini sudah diperiksa</option>')
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
                        $("#alamat").val(data.alamat);
                        $("#usia").val(data.usia);
                        siswaId = data.siswa_id;
                    }
                })
            });

            const form = $('.steps-validation').show();

            $('.steps-validation').steps({
                headerTag: 'h6',
                bodyTag: 'fieldset',
                titleTemplate: '<span class="number">#index#</span> #title#',
                labels: {
                    previous: '<i class="icon-arrow-left13 mr-2" /> Previous',
                    next: 'Next <i class="icon-arrow-right14 ml-2" />',
                    finish: 'Submit form <i class="icon-arrow-right14 ml-2" />'
                },
                transitionEffect: 'fade',
                autoFocus: true,
                onStepChanging: function (event, currentIndex, newIndex) {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {

                        // To remove error styles
                        form.find('.body:eq(' + newIndex + ') label.error').remove();
                        form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                    }

                    form.validate().settings.ignore = ':disabled,:hidden';
                    return form.valid();
                },
                onFinishing: function (event, currentIndex) {
                    const jumlahSoal = {{ count($soalButaWarna) }};
                    const alamat = '{{ route('pemeriksaanBw.store') }}';
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    let hasilPemeriksaan = [];
                    for(let i = 0; i < jumlahSoal; i++)
                    {
                        let soalId = document.querySelector("#soal"+i).value;
                        let jawaban = document.querySelector("#jawaban"+i).value;
                        hasilPemeriksaan[i] = {soalId,jawaban};
                    }

                    if(hasilPemeriksaan[hasilPemeriksaan.length - 1].jawaban != null && hasilPemeriksaan[hasilPemeriksaan.length - 1].jawaban != ''){
                        $.ajax({
                            url : alamat,
                            method : 'POST',
                            headers: {
                                'X-CSRF-TOKEN':token
                            },
                            data : {
                                hasilPemeriksaan,
                                jenisPemeriksaan: {{ $id }},
                                siswaId:siswaId
                            },
                            success:function(response){
                                $('#detailForm')[0].reset();
                                $('#siswaForm')[0].reset();
                                $("#table").DataTable().ajax.reload();
                                swalInit({
                                    type: 'success',
                                    title : response,
                                });
                            },
                            errorr:function(xhr){
                                swalInit({
                                    type: 'error',
                                    title : xhr.responseText,
                                });
                            }
                        });
                    }

                    form.validate().settings.ignore = ':disabled';
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    $("#bwForm")[0].reset();
                }
            });

            $('.steps-validation').validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-invalid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                }
            });
        });

        $(document).on('click','.delete',function(){
            const id = $(this).data("id");
            let alamat = '{{ route('pemeriksaanBw.destroy',':id') }}';
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
                        headers :{
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        data: {
                            _method: 'Delete'
                        },
                        success: function(){
                            $("#table").DataTable().ajax.reload();
                            swalInit({
                                type: 'success',
                                title : 'Data kelurahan berhasil dihapus',
                            });
                        }
                    })
                }
            })
        })
	</script>
@endsection