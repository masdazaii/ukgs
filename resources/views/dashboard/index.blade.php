@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="media">
					<div class="media-body">
						<h3 class="font-weight-semibold mb-0">{{ $top['sekolah'] }}</h3>
						<span class="text-uppercase font-size-sm text-muted">Total Sekolah</span>
					</div>

					<div class="text-right">
						<i class="icon-office icon-3x text-success-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="media">
					<div class="media-body">
						<h3 class="font-weight-semibold mb-0">{{ $top['siswa'] }}</h3>
						<span class="text-uppercase font-size-sm text-muted">Total Siswa</span>
					</div>
					<div class="text-right">
						<i class="icon-vcard icon-3x text-blue-700"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="media">
					<div class="media-body">
						<h3 class="font-weight-semibold mb-0">{{ $top['kelurahan'] }}</h3>
						<span class="text-uppercase font-size-sm text-muted">Total kelurahan</span>
					</div>
					<div class="text-right">
						<i class="icon-location4 icon-3x text-grey-800"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="media">
					<div class="media-body">
						<h3 class="font-weight-semibold mb-0">{{ $top['pemeriksa'] }}</h3>
						<span class="text-uppercase font-size-sm text-muted">Total Dokter</span>
					</div>
					<div class="text-right">
						<i class="icon-user-tie icon-3x text-danger-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Pilih tahun ajaran untuk menampilkan data</h5>
	</div>

	<div class="card-body">
		<div class="chart-container">
			<select class="form-control" id="tahunAjaran">
				<option>Pilih tahun ajaran</option>
				@for($i = 0; $i < count($tahunAjaran); $i++)
					<option value="{{$tahunAjaran[$i]->tahun_ajaran_id}}">{{$tahunAjaran[$i]->tahun_ajaran }}</option>
				@endfor
			</select>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Data Pemeriksaan masuk per bulan</h5>
		<div class="header-elements">
			<div class="list-icons">
        		<a class="list-icons-item" data-action="collapse"></a>
        	</div>
    	</div>
	</div>

	<div class="card-body">
		<div class="chart-container">
			<div class="chart" id="pemeriksaanChart"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Data OHIS per kelurahan</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                	</div>
            	</div>
			</div>

			<div class="card-body">
				<div class="chart-container text-center">
					<div class="d-inline-block" id="ohisChart"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Data FS per kelurahan</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                	</div>
            	</div>
			</div>

			<div class="card-body">
				<div class="chart-container text-center">
					<div class="d-inline-block" id="fsChart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Data buta warna per kelurahan</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                	</div>
            	</div>
			</div>

			<div class="card-body">
				<div class="chart-container text-center">
					<div class="d-inline-block" id="butaWarnaChart"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Data Pemeriksaan IMT per kelurahan</h5>
		<div class="header-elements">
			<div class="list-icons">
        		<a class="list-icons-item" data-action="collapse"></a>
        	</div>
    	</div>
	</div>

	<div class="card-body">
		<div class="chart-container">
			<div class="chart" id="imtChart"></div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Pemeriksaan Sosial</h5>
		<div class="header-elements">
			<div class="list-icons">
        		<a class="list-icons-item" data-action="collapse"></a>
        	</div>
    	</div>
	</div>

	<div class="card-body">
		<div class="chart-container">
			<div class="chart" id="sosialChart"></div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Rerata tekanan darah per kelurahan</h5>
				<div class="header-elements">
					<div class="list-icons">
		        		<a class="list-icons-item" data-action="collapse"></a>
		        	</div>
		    	</div>
			</div>
			<div class="card-body">
				<div class="table-responsive table-scrollable">
					<table class="table table-bordered" id="tekananDarah">
						<thead>
							<tr>
								<th>Kelurahan</th>
								<th>Tekanan darah</th>
							</tr>
						</thead>
						<tbody id="data">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Kesehatan Gusi</h5>
				<div class="header-elements">
					<div class="list-icons">
		        		<a class="list-icons-item" data-action="collapse"></a>
		        	</div>
		    	</div>
		    </div>
		    <div class="card-body">
				<div class="chart-container text-center">
					<div class="d-inline-block" id="kesehatanGusiChart"></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('librariesJS')
	<script src="{{ asset('limitless/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('limitless/global_assets/js/plugins/visualization/c3/c3.min.js') }}"></script>
	{{-- <script src="{{ asset('limitless/global_assets/js/demo_pages/charts/c3/c3_lines_areas.js') }}"></script> --}}
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			let tahunAjaran,pemeriksaan,ohis,fs,imt,butaWarna,sosial,kesehatanGusi;
			$('#tahunAjaran').on('change',function(){
				tahunAjaran = $(this).val();
				pemeriksaan = pemeriksaanChart(tahunAjaran);
				imt = imtChart(tahunAjaran);
				ohis = ohisChart(tahunAjaran);
				fs = fsChart(tahunAjaran);
				butaWarna = butaWarnaChart(tahunAjaran);
				sosial = sosialChart(tahunAjaran);
				kesehatanGusi = kesehatanGusiChart(tahunAjaran);
				tekananDarahChart(tahunAjaran);
			})

			function pemeriksaanChart(tahunAjaran){
				let pemeriksaanUrl = '{{ route('pemeriksaanChart',':id') }}';
				pemeriksaanUrl = pemeriksaanUrl.replace(':id',tahunAjaran);
				c3.generate({
	                bindto: '#pemeriksaanChart',
	                size: { height: 300 },
	                data: {
	                    url : pemeriksaanUrl,
	                    mimeType: 'json',
	                    type: 'bar'
	                },
	                color: {
	                    pattern: ['#2196F3', '#FF9800']
	                },
	                bar: {
	                    width: {
	                        ratio: 0.5
	                    }
	                },
	                axis: {
	                    y: {
	                        show: true
	                    },
	                    x: {
	                        type: 'category',
	                        categories : ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Des'],
	                        tick: {
	                            x: {
	                                multiline : false,
	                                culling : {
	                                    max: 1
	                                }
	                            }
	                        }
	                    }
	                }
	            });
			}

			function imtChart(tahunAjaran){
				let imtUrl = '{{ route('imtChart',':id') }}';
				imtUrl = imtUrl.replace(':id',tahunAjaran);
				c3.generate({
	                bindto: '#imtChart',
	                size: { height: 300 },
	                data: {
	                	x: 'x',
	                    url : imtUrl,
	                    mimeType: 'json',
	                    type: 'bar'
	                },
	                color: {
	                    pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
	                },
	                bar: {
	                    width: {
	                        ratio: 0.2
	                    }
	                },
	                axis: {
	                    y: {
	                        show: true
	                    },
	                    x: {
	                        type: 'category',
	                        tick: {
	                            x: {
	                            	format: function(x){
	                            		return x;
	                            	},
	                                multiline : false,
	                                culling : {
	                                    max: 1
	                                }
	                            }
	                        }
	                    }
	                }
	            });
			}

			function ohisChart(tahunAjaran){
				let ohisUrl = '{{ route('ohisChart',':id') }}';
				ohisUrl = ohisUrl.replace(':id',tahunAjaran);
				c3.generate({
	                bindto: '#ohisChart',
	                size: { width: 250 },
	                color: {
	                    pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
	                },
	                data: {
	                    url: ohisUrl,
	                    mimeType: 'json',
	                    type : 'pie',
	                },
	                legend: {
	                	show : true
	                }
	            });
			}

            function fsChart(tahunAjaran){
            	let fsUrl = '{{ route('fsChart',':id') }}';
            	fsUrl = fsUrl.replace(':id',tahunAjaran);
            	c3.generate({
	            bindto:'#fsChart',
	                size: { width: 250 },
	                color: {
	                    pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
	                },
	                data: {
	                    url: fsUrl,
	                    mimeType: 'json',
	                    type : 'donut'
	                },
	                donut: {
	                    title: "Fissure Sealant"
	                }
	            });
        	}

            function butaWarnaChart(tahunAjaran){
            	let butaWarnaUrl = '{{ route('butaWarnaChart',':id') }}';
            	butaWarnaUrl = butaWarnaUrl.replace(':id',tahunAjaran);
	            c3.generate({
	                bindto: '#butaWarnaChart',
	                size: { width: 250 },
	                color: {
	                    pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
	                },
	                data: {
	                    url: butaWarnaUrl,
	                    mimeType: 'json',
	                    type : 'pie',
	                },
	                legend: {
	                	show : true
	                }
	            });
        	}

            function sosialChart(tahunAjaran){
            	let sosialUrl = '{{ route('sosialChart',':id') }}';
            	sosialUrl = sosialUrl.replace(':id',tahunAjaran);
	            c3.generate({
	                bindto: '#sosialChart',
	                size: { height: 300 },
	                point: {
	                    r: 4
	                },
	                color: {
	                    pattern: ['#E53935', '#3949AB','#3F51B5', '#FF9800']
	                },
	                data: {
	                	x:'x',
	                	url: sosialUrl,
	                	mimeType: 'json',
	                    types:'area-spline'
	                },
	                grid: {
	                    y: {
	                        show: true
	                    }
	                },
	                axis: {
	                	x: {
	                		type: 'category',
	                    	tick:{
	                    		x: function(x){
	                    			return x;
	                    		},
	                    		multiline : false,
	                            culling : {
	                                max: 1
	                            }
	                    	}
	                    }
	                }
	            });
	        }

	        function tekananDarahChart(tahunAjaran){
	        	let tekananDarahUrl = '{{ route('tekananDarahChart',':id') }}';
            	tekananDarahUrl = tekananDarahUrl.replace(':id',tahunAjaran);
	        	$.ajax({
	        		url: tekananDarahUrl,
	        		type: 'GET',
	        		success:function(response){
	        			$('#data tr').remove();
	        			for (let i = 0; i < response.length; i++) {
	        				let row = '<tr><td>'+response[i].kelurahan+'</td>'+'<td>'+response[i].rerata+'</td></tr>';
	        				$(row).appendTo('#data');
	        			}
	        		}
	        	})
	        }

	        function kesehatanGusiChart(tahunAjaran)
	        {
	        	let kesehatanGusiUrl = '{{ route('kesehatanGusiChart',':id') }}';
            	kesehatanGusiUrl = kesehatanGusiUrl.replace(':id',tahunAjaran);
	            c3.generate({
	                bindto: '#kesehatanGusiChart',
	                size: { height: 200 },
	                data: {
	                	x: 'x',
	                    url : kesehatanGusiUrl,
	                    mimeType: 'json',
	                    type: 'bar'
	                },
	                color: {
	                    pattern: ['#3F51B5', '#FF9800', '#4CAF50', '#00BCD4', '#F44336']
	                },
	                bar: {
	                    width: {
	                        ratio: 0.2
	                    }
	                },
	                axis: {
	                    y: {
	                        show: true
	                    },
	                    x: {
	                        type: 'category',
	                        tick: {
	                            x: {
	                            	format: function(x){
	                            		return x;
	                            	},
	                                multiline : false,
	                                culling : {
	                                    max: 1
	                                }
	                            }
	                        }
	                    }
	                }
	            });
	        }

        	// Resize chart on sidebar width change
	        $('.sidebar-control').on('click', function() {
	            pemeriksaan.resize();
	            ohis.resize();
	            fs.resize();
	            butaWarna.resize();
	            imtChart.resize();
	            sosialChart.resize();
	        });
		})
	</script>
@endsection
