@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		<div class="row">
			@if ($listKegiatan == 1)
			<div class="col-md-6">
				<div class="row" style="margin-bottom: 5px;">
					<div class="col-auto mr-auto"><h5>Progress Hari Ini</h5></div>
					<div class="col-auto">
						@if(Auth::user()->akses_submit == 1)
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#submit">Submit Kegiatan</button>
						@endif
					</div>
				</div>
				
				<div class="progress" style="height:2em">
					<div class="progress-bar bg-success" role="progressbar" style="width:{{count($sudah)/count($kegiatan)*100}}%" aria-valuenow="{{count($sudah)/count($kegiatan)*100}}" aria-valuemin="0" aria-valuemax="100">{{round(count($sudah)/count($kegiatan)*100)}}%</div>
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
								<i class="fa fa-square text-danger"></i> : Tidak melakukan semua kegiatan
							</li>
						</ul>
					</div>
				</small>
			</div>
			
			@else
			<div class="col-md-12">
				<div class="alert alert-warning">
					<p>Anda belum memiliki list kegiatan. Klik <a href="{{url('activity')}}">DISINI</a> untuk menambah kegiatan.</p>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>

{{-- SUBMIT ACTIVITY MODAL --}}
<div class="modal fade" id="submit" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Submit Activity</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
          		</button>
			</div>
			<div class="modal-body">
				@if($cekKategori == 'ada')
					@if(count($belum) == 0)
					<div class="alert alert-success">Kamu sudah submit semua kegiatan.</div>
					@else
					<form action="{{route('activity.submit')}}" id="kegiatan" method="POST">
						{{ csrf_field() }}
						@foreach ($belum as $kegiatan)
						<div class="form-check">
							<input type="checkbox" class="form-check-input" value="{{$kegiatan->id}}" id="kegiatan" name="kegiatan[]" >
							<label for="kegiatan" class="form-check-label">{{$kegiatan->nama}}</label>
						</div>
						@endforeach
					@endif
				@else
				{{$cekKategori}}
				<p>Klik <a href="{{url('activity')}}">Disini</a> Untuk menambah kegiatan</p>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary">Save changes</button>
        		</form>
			</div>
		</div>
	</div>
</div>
@stop