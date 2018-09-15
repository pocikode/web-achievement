@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		@if (count($belum) > 0 && $listKegiatan == 1)
		<div class="alert alert-warning" role="alert">
			<h5 class="alertheading">Ayo, jangan tunda lagi!</h5>
			<span>Hari ini kamu belum melakukan :</span> <br>
			<ul>
				@foreach ($belum as $list)
				<li>{{$list->nama}}</li>
				@endforeach
			</ul>
			<hr>
			<span class="mb-0">Submit kegiatan yang sudah kamu lakukan disini <i class="fa fa-hand-o-right" aria-hidden="true"></i></span>&nbsp;
			<a class="btn btn-secondary" href="{{url('activity/submit')}}">Submit</a>
		</div>
		@elseif (count($belum) == 0 && $listKegiatan == 1)
		<div class="alert alert-success">Sudah dilaksanakan ndan!</div>
		@else
		<div class="alert alert-warning">
			<strong>Kamu belum memiliki kegiatan</strong>
		</div>
		<span class="mb-0">Untuk menambah kegiatan bisa klik <i class="fa fa-hand-o-right" aria-hidden="true"></i></span>&nbsp;
			<a class="btn btn-secondary" href="{{url('activity')}}">Disini</a></span>
		@endif
	</div>

</div>
@stop