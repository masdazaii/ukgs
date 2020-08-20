@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home - Pemeriksaan Buta Warna</span> - edit </h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="{{ URL::to('/pemeriksaan/'.$pemeriksaanBw->jenis_pemeriksaan.'/periksa/'.$sekolahId) }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Pemeriksaan Buta Warna</a>
		        		<span class="breadcrumb-item active">edit</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}

    <!-- Wizard with validation -->
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Edit pemeriksaan buta warna</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <form id="bwForm" class="wizard-form steps-validation" action="#" data-fouc>
            @for($i = 0;$i < count($pemeriksaanBw->detailPemeriksaanBw); $i++)
                <h6>Soal ke-{{$i+1}}</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-4 text-center" style="margin: 0 auto; float: none;">
                            <!-- Zooming -->
                            <div class="card">
                                <input type="hidden" id="soal{{ $i }}" value="{{ $pemeriksaanBw->detailPemeriksaanBw[$i]->soal_bw_id }}">
                                <div class="card-img-actions">
                                    <img class="card-img-top img-fluid" src="{{ '/'.$pemeriksaanBw->detailPemeriksaanBw[$i]->soalButaWarna->image }}">
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Deskripsi Soal</h5>
                                    <p class="card-text">{{ $pemeriksaanBw->detailPemeriksaanBw[$i]->soalButaWarna->deskripsi }}</p>
                                    <div class="form-group">
                                        <label>Jawaban<span class="text-danger">*</span></label>
                                        <input type="number" value="{{ $pemeriksaanBw->detailPemeriksaanBw[$i]->jawaban }}" id="jawaban{{$i}}" class="form-control required">
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
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/demo_pages/content_cards_content.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
            const form = $('.steps-validation').show();
            const swalInit = swal.mixin({
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-light'
            });

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
                    const jumlahSoal = {{ count($pemeriksaanBw->detailPemeriksaanBw) }};
                    const alamat = '{{ route('pemeriksaanBw.update',$pemeriksaanBw->pemeriksaan_id) }}';
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    // console.log(token);
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
                                _method: 'PUT'
                            },
                            success: function(response){
                                swalInit({
                                    type: 'success',
                                    title : response,
                                }).then(function(){
                                    location.href = '{{ url('pemeriksaan/'.$jenisPemeriksaanId.'/periksa/'.$sekolahId) }}';
                                })
                            },
                            error: function(xhr){
                                swalInit({
                                    type: 'error',
                                    title : xhr.responseText,
                                });
                            }
                        });
                    }

                    form.validate().settings.ignore = ':disabled';
                    return form.valid();
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
	</script>
@endsection
