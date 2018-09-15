@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		@csrf
		<h3>Submit Kegiatan :</h3>
		<form action="{{route('activity.submit')}}" id="kegiatan" method="POST">
			{{ csrf_field() }}
			@foreach ($belum as $kegiatan)
			<div class="form-check">
				<input type="checkbox" class="form-check-input" value="{{$kegiatan->id}}" id="kegiatan{{$no}}" name="kegiatan[]" >
				<label for="kegiatan{{$no}}" class="form-check-label">{{$kegiatan->nama}}</label>
			</div>
			@php $no++; @endphp
			@endforeach
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="submit">Submit</button>
			</div>
		</form>
	</div>

</div>
@stop