@extends('template')

@section('main')
<div class="row main">
	@csrf
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		@if($partner == 0) 
		<div class="alert alert-warning">Kamu belum memiliki partner!</div>
		<h6>Pilih partner kamu :</h6>

		<form action="{{route('partner.update', Auth::user()->id)}}" method="post">
			@method('PUT')
			{{ csrf_field() }}

			<script>
				function partnerId() {
					var id = document.getElementById("partner").value;
					var name = document.getElementById("user"+id).innerText;

				    document.getElementById("partnerName").innerHTML = name;
				}
			</script>
			<select name="partner" id="partner" >
				@foreach($pilihPartner as $list)
				<option id="user{{$list->id}}" value="{{$list->id}}">{{$list->name}}</option>
				@endforeach
			</select>

			<button class="btn btn-info" type="button" data-toggle="modal" data-target="#submitPartner" onclick="partnerId(); return false;">Submit</button>
			{{--SUBMIT PARTNER MODAL--}}
			<div class="modal fade" id="submitPartner" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body text-center">
							<h5 class="modal-title">Apakah kamu yakin?</h5>
							<p>Menjadikan <strong id="partnerName"></strong> partnermu?</p>
							<div class="">
				        		<button type="submit" class="btn btn-primary">Ya</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</form>

		@else

		@php 
			$partner = DB::table('santris')->where('id', Auth::user()->partner)->value('name');
		@endphp
			
			@if($totalPartnerActivity == 0)
			<div class="alert alert-warning">
				<p>{{ $partner }} belum memiliki list kegiatan.</p>
			</div>
			@else
			<div class="row">
				<div class="col-md-7">
					<div class="row" style="margin-bottom: 5px;">
						<div class="col-auto mr-auto"><h5>Progress {{ $partner }} Hari Ini</h5></div>
						<div class="col-auto">
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#submit">Submit Kegiatan</button>
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
				
				<!-- Aksses Submit -->
				<div class="col-md-5">
					<p>Akses Submit : <strong class="col-auto"> @if($aksesSubmit == 0) Tidak @else Ya @endif </strong></p>
					<button class="btn btn-primary" onclick="window.location.href='{{url('partner/akses-true')}}'">Berikan Akses Submit</button>
					<button class="btn btn-warning" onclick="window.location.href='{{url('partner/akses-false')}}'">Hapus Akses Submit</button>
				</div>
			</div>
			@endif

		@endif
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
					<div class="alert alert-success">{{ $partner }} sudah melaksanakan semua kegiatan.</div>
					@else
					<form action="{{url('partner')}}" id="kegiatan" method="POST">
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