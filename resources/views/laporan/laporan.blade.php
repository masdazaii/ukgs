<!DOCTYPE html>
<html>
<head>
	<title>Laporan PDF</title>
	<style type="text/css">
		table,th,td{
			border: 1px solid black;
		}

		th, td{
			padding: 10px;
			font-size: 12px;
		}

		table{
			width: 95%;
			border-collapse: collapse;
		}

		.th-bawah{
			border-bottom: none;
		}

		.td-top{
			border-top: none;
		}

		@page{
			margin: 0px;
			padding: 0px;
		}
	</style>
</head>
<body>
	<center><h3>Judul laporan + sekolah</h3></center>
	<center><h4>Puskesmas kebayoran<h4></center>
	<center><p><i>Alamat</i></p></center>
	<center>
		<table>
			<tr>
				<th class="th-bawah">No</th>
				<th width="10%" class="th-bawah">Nama Siswa</th>
				<th class="th-bawah">Usia (tahun)</th>
				<th class="th-bawah">Jenis Kelamin</th>
				<th width="10%" colspan="4">IMT</th>
				<th width="7%" colspan="2">OHI-S</th>
				<th width="15%" colspan="6">Gigi Desidul</th>
				<th width="15%" colspan="6">Gigi Permanen</th>
				<th class="th-bawah">Kesehatan Gusi</th>
				<th width="12%" class="th-bawah">Frekuensi Menyikat Gigi</th>
				<th class="th-bawah">Mata Penglihatan</th>
				<th class="th-bawah">Telinga Pendengaran</th>
			</tr>
			<tr>
				<td class="td-top"></td>
				<td class="td-top"></td>
				<td class="td-top"></td>
				<td class="td-top"></td>
				<td>BB</td>
				<td>TB</td>
				<td>&#931</td>
				<td>Status</td>
				<td>&#931</td>
				<td>Status</td>
				<td>&#931 Gigi Desidul</td>
				<td>d</td>
				<td>e</td>
				<td>f</td>
				<td>def-t</td>
				<td>EXO-Pers</td>
				<td>&#931 Gigi Permanen</td>
				<td>d</td>
				<td>m</td>
				<td>f</td>
				<td>dmf-t</td>
				<td>FS</td>
				<td class="td-top"></td>
				<td class="td-top"></td>
				<td class="td-top"></td>
				<td class="td-top"></td>
			</tr>
			{{-- @php
				$no = 0;
			@endphp
			@for($i =0; $i < count($kelas);$i++)
				@foreach($kelas[$i]->kelasMapping as $data)
					@if(count($data->siswa->deskripsi_pemeriksaan) >= 3)
						<tr>
							<td>{{ $no+1 }}</td>
							<td>{{ $data->siswa->nama }}</td>
							<td>{{ $data->siswa->usia }}</td>
							<td>{{ $data->siswa->jenis_kelamin }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_imt']->berat_badan }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_imt']->tinggi_badan }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_imt']->berat_badan+$data->siswa->deskripsi_pemeriksaan['pemeriksaan_imt']->tinggi_badan }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_imt']->status }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis }}</td>
							<td>
								@if($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis >= 0 && $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis <= 1.2)
										Baik
								@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis > 1.2 && $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis <= 3)
										Cukup
								@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis > 3 && $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->ohis <= 6)
										Kurang
								@endif
							</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->jumlahDef }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->defD }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->defE }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->defF }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->skorDefT }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->exoPers }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->jumlahDmf }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfD }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfM }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfF }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->skorDmfT }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->fs }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->kesehatanGusi }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->frekuensiMenyikatGigi }}</td>
							<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_bw']->rujukan }}</td>
						</tr>
					@endif
				@endforeach
			@endfor --}}
		</table>
	</center>
</body>
</html>