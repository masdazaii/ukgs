<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Siswa</th>
			<th>Usia (tahun)</th>
			<th>Jenis Kelamin</th>
			<th colspan="4">IMT</th>
			<th colspan="2">OHI-S</th>
			<th colspan="6">Gigi Desidul</th>
			<th colspan="6">Gigi Permanen</th>
			<th>Kesehatan Gusi</th>
			<th>Frekuensi Menyikat Gigi</th>
			<th>Mata Penglihatan</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>BB</td>
			<td>TB</td>
			<td></td>
			<td>Status</td>
			<td></td>
			<td>Status</td>
			<td>Gigi Desidul</td>
			<td>d</td>
			<td>e</td>
			<td>f</td>
			<td>def-t</td>
			<td>EXO-Pers</td>
			<td>Gigi Permanen</td>
			<td>d</td>
			<td>m</td>
			<td>f</td>
			<td>dmf-t</td>
			<td>FS</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@php
			$no = 0;
		@endphp
		@foreach($kelas->kelasMapping as $data)
			@if(count($data->siswa->deskripsi_pemeriksaan) >= 3)
				<tr>
					<td>{{ $no++ }}</td>
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
					<td>
						@if($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->exoPers == 0)
							-
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->exoPers ==1)
							+
						@endif
					</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->jumlahDmf }}</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfD }}</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfM }}</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->dmfF }}</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->skorDmfT }}</td>
					<td>
						@if($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->fs == 0)
							-
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->fs ==1)
							+
						@endif
					</td>
					<td>
						@if($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->kesehatanGusi == 0)
							Baik
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->kesehatanGusi ==1)
							Cukup
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->kesehatanGusi ==1)
							Kurang
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->kesehatanGusi ==1)
							Jelek
						@endif
					</td>
					<td>{{ $data->siswa->deskripsi_pemeriksaan['pemeriksaan_gigi']->frekuensiMenyikatGigi }}</td>
					<td>
						@if($data->siswa->deskripsi_pemeriksaan['pemeriksaan_bw']->rujukan == 0)
							Normal
						@elseif($data->siswa->deskripsi_pemeriksaan['pemeriksaan_bw']->rujukan ==1)
							Perlu dirujuk
						@endif
					</td>
				</tr>
			@endif
		@endforeach
	</tbody>
</table>