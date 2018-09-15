@extends('admin.template')

@section('main')
@csrf
<div class="row">
	<div class="col-auto mr-auto">
		<h2>Daftar Kategori</h2>
	</div>
	<div class="col-auto">
		<button type="bu'" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addActivity">Tambah Kategori</button>
	</div>
</div>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col-6">No</th>
			<th scope="col">Nama Kategori</th>
			<th scope="col">Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $kat)
		<tr>
			<th scope="row">{{$kat['id']}}</th>
			<td>{{$kat['nama']}}</td>
			<td></td>
		</tr>
		@endforeach
	</tbody>
</table>

<!-- Modal add Activity -->
<div class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="addActivityLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addActivityLabel">Tambah Kategori</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nama">Nama Kategori</label>
						<input type="text" class="form-control" id="nama" name="nama">
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop