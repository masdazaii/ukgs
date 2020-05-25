@extends('layouts.app')
@section('content')
	{{-- Start Breadcrumb --}}
		<div class="page-header page-header-light mb-3">
		  	<div class="page-header-content header-elements-md-inline">
		    	<div class="page-title d-flex">
		    		{{-- Breadcrumb tittle --}}
		      		<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Rujukan</h4>
		    	</div>
		  	</div>
		  	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		    	<div class="d-flex">
		      		<div class="breadcrumb">
		      			{{-- Breadcrumb content --}}
		        		<a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
		        		<span class="breadcrumb-item active">Rujukan</span>
		      		</div>
		    	</div>
		  	</div>
		</div>
	{{-- End Breadcrumb --}}
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-form-label col-lg-2">Nama sekolah</label>
                <div class="col-lg-10">
                    <input id="search" type="text" class="form-control" placeholder="Masukan nama sekolah">
                </div>
            </div>
        </div>
    </div>

	<div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Pemeriksaan</th>
                            <th>Deskrips</th>
                            <th>Penangan</th>
                            <th width="25%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/demo_pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
@endsection
@section('script')
	<script>
		$(document).ready(function() {
            let data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace("sekolah_id","sekolah_name"),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url:'{{ url('typeahead') }}'+'?term=%QUERY',
                    wildcard:'%QUERY'
                }
            })

            data.initialize();

            $('#search').typeahead(
                {
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name:'sekolah',
                    displayKey:'sekolah_name',
                    source: data.ttAdapter()
                }
            ).on('typeahead:selected',function(event,data){
                // console.log(data.sekolah_id);
                const id = data.sekolah_id;
                let url = '{{ route('rujukanAjax',':id') }}';
                url = url.replace(':id',id);
                $("#table").DataTable({
                    "destroy": true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": {'url':url,
                            'headers':"{{ csrf_token() }}"},
                    "order": ['0', 'desc'],
                    "dataSrc": "data",
                    "columns": [
                        {data: 'siswa_id',name:'siswa_id'},
                        {data: 'jenis_pemeriksaan', name: 'jenisPemeriksaan'},
                        {data: 'deskripsi',nama:'deskripsi'},
                        {data: 'penangan',nama:'penangan'},
                        {data: 'action', name: 'action', "orderable": false, "searchable": false}
                    ],
                    "fixedColumns": true,
                });
            })
        });

        $(document).on('click','.tangani',function(){
            const id = $(this).data('id');
            let tanganiUrl = '{{ route('tangani',':id') }}';
            tanganiUrl = tanganiUrl.replace(':id',id);
            console.log(tanganiUrl);
            $.ajax({
                url : tanganiUrl,
                method : 'POST',
                headers : {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                success: function(response){
                    $("#table").DataTable().ajax.reload();
                    Swal.fire({
                        type: 'success',
                        title : response,
                    });
                },
                error:function(xhr,status,error){
                    Swal.fire({
                        type: 'error',
                        title : xhr.responseText,
                    });
                }
            })
        })

        $(document).on('click','.edit',function(){
            var id = $(this).data("id");
            var alamat = '{{ route('kelurahan.update',':id') }}';
            alamat = alamat.replace(':id',id);
            $.ajax({
                url : '{{ url('kelurahanEditAjax') }}',
                headers : "{{ csrf_token() }}",
                method : 'get',
                data: {id:id},
                success : function(data){
                    $('#editForm').attr('action',alamat);
                    $('#modal_form_vertical_edit').modal('show');
                    $("#kelurahanNameEdit").val(data.kelurahan_name);
                }

            });
        });

        $(document).on('click','.editSubmit',function(){
            var kelurahanNameEdit = $('#kelurahanNameEdit').val();
            console.log(kelurahanNameEdit);
            var alamat = $('#editForm').attr('action');
            $.ajax({
                url : alamat,
                type: 'POST',
                data: {
                    kelurahanName:kelurahanNameEdit,
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT'
                },
                success:function(){
                    $('#modal_form_vertical_edit').modal('hide');
                    $("#table").DataTable().ajax.reload();
                    Swal.fire({
                        type: 'success',
                        title : 'Data kelurahan berhasil diupdate',
                    });
                }
            })
        })

        $(document).on('click','.delete',function(){
            var id = $(this).data("id");
            var alamat = '{{ route('kelurahan.destroy',':id') }}';
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
                        title : 'Data kelurahan berhasil dihapus',
                    });
                }
            })
        })
	</script>
@endsection