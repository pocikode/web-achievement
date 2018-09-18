@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		<div class="row">
			<div class="col-md-6">
				<div class="row" style="margin-bottom: 5px;">
					<div class="col-auto mr-auto"><h5>Progress Hari Ini</h5></div>
					<div class="col-auto">
						<button class="btn btn-info btn-sm">Submit Kegiatan</button>
					</div>
				</div>
				
				<div class="progress" style="height:2em">
					<div class="progress-bar bg-success" role="progressbar" style="width:{{count($sudah)/count($kegiatan)*100}}%" aria-valuenow="{{count($sudah)/count($kegiatan)*100}}" aria-valuemin="0" aria-valuemax="100">{{count($sudah)/count($kegiatan)*100}}%</div>
				</div>

				<ul class="list-group" style="margin-top: 10px; margin-bottom: 10px;">
					@foreach ($sudah as $keg)
					<li class="list-group-item list-group-item-success d-flex justify-content-between align-items-center">{{$keg->nama}}<span class="badge badge-success badge-pill"><i class="fa fa-check fa-lg" aria-hidden="true"></i></span></li>
					@endforeach
					@foreach ($belum as $keg)
					<li class="list-group-item list-group-item-warning">{{$keg->nama}}</li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-6">
				<h5>Progress Bulan {{ $namaBulan }}</h5>
				{!! $bulanan !!}
				<small class="row">
					<strong class="col-1">Keterangan</strong>
					<div class="col">
						<ul>
							<li style="list-style: none;">
								<i class="fa fa-square text-success"></i> : Melakukan semua kegiatan
							</li>
							<li style="list-style: none;">
								<i class="fa fa-square text-info"></i> : Hari ini
							</li>
						</ul>
					</div>
					<div class="col">
						<ul>
							<li style="list-style: none;">
								<i class="fa fa-square text-warning"></i> : Melakukan sebagian kegiatan
							</li>
							<li style="list-style: none;">
								<i class="fa fa-square text-danger"></i> : Tidak melakukan kegiatan
							</li>
						</ul>
					</div>
				</small>
			</div>
		</div>
		

	</div>

</div>
@stop