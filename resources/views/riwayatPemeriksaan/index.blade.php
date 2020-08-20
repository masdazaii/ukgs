@extends('layouts.app')
@section('content')
    {{-- Start Breadcrumb --}}
        <div class="page-header page-header-light mb-3">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    {{-- Breadcrumb tittle --}}
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Riwayat Rujukan</h4>
                </div>
            </div>
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        {{-- Breadcrumb content --}}
                        <a href="{{ URL::to('/') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item active">Riwayat Rujukan</span>
                    </div>
                </div>
            </div>
        </div>
    {{-- End Breadcrumb --}}

    <div class="card">
        <div class="card-header">
            <h4><span class="font-weight-semibold">Pilih Data</span></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nama sekolah</label>
                    <input id="search" type="text" class="form-control" placeholder="Masukan nama sekolah">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pilih Kelas</label>
                    <select class="form-control pilih-kelas">

                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pilih Siswa</label>
                    <select class="form-control pilih-siswa">

                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body hasil">
            <table width="100px" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Kesehatan Gusi</th>
                        <th width="25%" class="text-center">Frekuensi Menyikat Gigi</th>
                        <th colspan="2" class="text-center">OHI-S</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="kesehatanGusi">-</td>
                        <td id="frekuensiMenyikatGigi">-</td>
                        <td id="ohis">-</td>
                        <td id="ohisStatus">-</td>
                    </tr>
                </tbody>
            <table>
            <table class="table table-xs table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center">Gigi Desidul</th>
                        <th colspan="6" class="text-center">Gigi Permanen</th>
                    </tr>
                    <tr>
                        <th>&#931 Gigi Desidul</th>
                        <th>d</th>
                        <th>e</th>
                        <th>f</th>
                        <th>def-t</th>
                        <th>EXO-Pers</th>
                        <th>&#931 Gigi Permanen</th>
                        <th>d</th>
                        <th>m</th>
                        <th>f</th>
                        <th>dmf-t</th>
                        <th width="5%">FS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="totalDef">-</td>
                        <td id="defD">-</td>
                        <td id="defE">-</td>
                        <td id="defF">-</td>
                        <td id="defT">-</td>
                        <td id="exoPers">-</td>
                        <td id="totalDmf">-</td>
                        <td id="dmfD">-</td>
                        <td id="dmfM">-</td>
                        <td id="dmfF">-</td>
                        <td id="dmfT">-</td>
                        <td id="fs">-</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="text-center">Berat Badan</th>
                        <th class="text-center">Tinggi Badan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Vaksinasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="beratBadan">-</td>
                        <td id="tinggiBadan">-</td>
                        <td id="statusImt">-</td>
                        <td id="vaksinasi">-</td>
                    </tr>
                </tbody>
            <table>
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="text-center">Merokok</th>
                        <th class="text-center">Minum Alkohol</th>
                        <th class="text-center">Narkoba</th>
                        <th class="text-center">Vaksinasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="merokok">-</td>
                        <td id="minumAlkohol">-</td>
                        <td id="freeSex">-</td>
                        <td id="narkoba">-</td>
                    </tr>
                </tbody>
            <table>
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="text-center">Tekanan Sistolik</th>
                        <th class="text-center">Tekanan Diastolik</th>
                        <th class="text-center">Lingkar Pinggang</th>
                        <th class="text-center">Nilai Gula Darah Sewaktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="tekananSistolik">-</td>
                        <td id="tekananDiastolik">-</td>
                        <td id="lingkarPinggang">-</td>
                        <td id="nilaiGulaDarahSewaktu">-</td>
                    </tr>
                </tbody>
            <table>
        </div>
    </div>

@endsection
@section('librariesJS')
    <script src="{{ asset('limitless/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('limitless/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
@endsection
@section('script')
    <script>
        const swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });

        $(document).ready(function() {
            let data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace("sekolah_id","sekolah_name"),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                url:'{{ url('typeaheadRiwayat') }}'+'?term=%QUERY',
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
                $('.pilih-kelas option').remove();
                $.ajax({
                    url : '{{ url('riwayatKelas') }}',
                    type : 'GET',
                    data : {
                        sekolahId : data.sekolah_id
                    },
                    success : function(response){
                        if(response.length > 0){
                            $('.pilih-kelas').append('<option>Silahkan pilih kelas</option>')
                            for (let i = 0; i < response.length; i++) {
                                $('.pilih-kelas').append('<option value='+response[i].kelas_id+'>'+response[i].kelas_name+'</option>')
                            }
                        }else{
                            $('.pilih-kelas').append('<option>Tidak ada data kelas dalam sekolah ini</option>')
                        }
                    }
                })
            })

            $('.pilih-kelas').on('change',function(){
                $('.pilih-siswa option').remove();
                const id = $(this).val();
                $.ajax({
                    url : '{{ url('riwayatSiswa') }}',
                    type: 'GET',
                    data: {
                        kelasId : id
                    },
                    success: function(response){
                        if(response.length > 0){
                            $('.pilih-siswa').append('<option>Silahkan pilih siswa</option>')
                            for (let i = 0; i < response.length; i++) {
                                $('.pilih-siswa').append('<option value='+response[i].siswa_id+'|'+response[i].tahun_ajaran.tahun_ajaran_id+'>'+response[i].siswa.nama+' ('+response[i].tahun_ajaran.tahun_ajaran+')'+'</option>')
                            }
                        }else{
                            $('.pilih-siswa').append('<option>Tidak ada data siswa dalam kelas ini</option>')
                        }
                    }
                })
            })

            $('.pilih-siswa').on('change',function(){
                const data = $(this).val();
                $.ajax({
                    url : '{{ url('riwayatPemeriksaanSiswa') }}',
                    type : 'GET',
                    data : {
                        data : data
                    },
                    success : function(response){
                        if(response.length == 0){
                            swalInit({
                                type : 'warning',
                                title : "Data pemeriksaan tidak ditemukan"
                            })
                        }else{
                            if(response.hasOwnProperty('pemeriksaangigi')){
                                makePemeriksaanGigi(response.pemeriksaangigi);
                            }
                            if (response.hasOwnProperty('pemeriksaanimt')) {
                                makePemeriksaanImt(response.pemeriksaanimt);
                            }
                            if (response.hasOwnProperty('pemeriksaansosial')) {
                                makePemeriksaanSosial(response.pemeriksaansosial);
                            }
                            if (response.hasOwnProperty('pemeriksaanptm')) {
                                makePemeriksaanPtm(response.pemeriksaanptm);
                            }
                            // makePemeriksaanBw(response.pemeriksaanbw);
                        }
                    }
                })
            })

            function makePemeriksaanGigi(response)
            {
                const kesehatanGusi = document.getElementById('kesehatanGusi').innerText = response.kesehatanGusi;
                const frekuensiMenyikatGigi = document.getElementById('frekuensiMenyikatGigi').innerText = response.frekuensiMenyikatGigi;
                const ohis = document.getElementById('ohis').innerText = response.ohis;
                const ohisStatus = document.getElementById('ohisStatus');
                if (response.ohis >= 0 && response.ohis <= 1.2) {
                    ohisStatus.innerText = "Normal";
                }else if(response.ohis > 1.2 && response.ohis <= 3){
                    ohisStatus.innerText = "Cukup";
                }else if(response.ohis > 3 && response.ohis <= 6){
                    ohisStatus.innerText = "Kurang";
                }
                const totalDef = document.getElementById('totalDef').innerText = response.jumlahDef;
                const defD = document.getElementById('defD').innerText = response.defD;
                const defE = document.getElementById('defE').innerText = response.defE;
                const defF = document.getElementById('defF').innerText = response.defF;
                const defT = document.getElementById('defT').innerText = response.skorDefT;
                const exoPers = document.getElementById('exoPers');
                if(response.exo_pers == 1){
                    exoPers.innerText = "+";
                }else{
                    exoPers.innerText = "-";
                }
                const totalDmf = document.getElementById('totalDmf').innerText = response.jumlahDmf;
                const dmfD = document.getElementById('dmfD').innerText = response.dmfD;
                const dmfM = document.getElementById('dmfM').innerText = response.dmfM;
                const dmfF = document.getElementById('dmfF').innerText = response.dmfF;
                const dmfT = document.getElementById('dmfT').innerText = response.skorDmfT;
                const fs = document.getElementById('fs');
                if(response.fs == 1){
                    fs.innerText = "+";
                }else{
                    fs.innerText = "-";
                }
            }


            function makePemeriksaanImt(response)
            {
                const bb = document.getElementById('beratBadan').innerText = response.berat_badan;
                const tb = document.getElementById('tinggiBadan').innerText = response.tinggi_badan;
                const statusImt = document.getElementById('statusImt').innerText = response.status;
                const vaksin = document.getElementById('vaksinasi');
                if (response.vaksin == 1) {
                    vaksin.innerText = "sudah";
                }else{
                    vaksin.innerText = "belum"
                }
            }

            function makePemeriksaanSosial(response)
            {
                const merokok = document.getElementById('merokok').innerText = yesNo(response.merokok);
                const minumAlkohol = document.getElementById('minumAlkohol').innerText = yesNo(response.minum_alkohol);
                const narkoba = document.getElementById('narkoba').innerText = yesNo(response.narkoba);
                const freeSex = document.getElementById('freeSex').innerText = yesNo(response.free_sex);
            }

            function makePemeriksaanPtm(response)
            {
                const tekananSistolik = document.getElementById('tekananSistolik').innerText = response.tekanan_sistolik;
                const tekananDiastolik = document.getElementById('tekananDiastolik').innerText = response.tekanan_diastolik;
                const lingkarPinggang = document.getElementById('lingkarPinggang').innerText = response.lingkar_pinggang;
                const nilaiGulaDarahSewaktu = document.getElementById('nilaiGulaDarahSewaktu').innerText = response.nilai_gula_darah_sewaktu;
            }


            function yesNo(val)
            {
                if (val == 1) {
                    return "ya";
                }else{
                    return "tidak";
                }
            }
        });
    </script>
@endsection
