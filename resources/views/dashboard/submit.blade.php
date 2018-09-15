@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	{{-- CONTENT --}}
	<div class="col-md-10">
		<h3>Submit Kegiatan :</h3>
		<form action="" id="kegiatan">
			<input type="hidden" id="formID" value="0">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="kegiatan">Pilih Kegiatan</label>
				</div>
				<div class="col-md-6">
					<select id="kegiatan" class="form-control" name="nama[]">
						@foreach ($belum as $kegiatan)
						<option value="{{$kegiatan['id']}}">{{$kegiatan['nama']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="jumlah">Jumlah</label>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" name="jumlah[]" id="jumlah">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="keterangan">Keterangan</label>
				</div>
				<div class="col-md-6">
					<textarea name="keterangan[]" id="keterangan" class="form-control"></textarea>
				</div>
			</div>

		</form>
		<button class="btn btn-info" type="button" onclick="tambahForm(); return false;">Tambah Form</button>
	</div>

</div>
@stop