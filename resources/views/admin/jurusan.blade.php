@extends('admin.template')

@section('main')
@csrf
<div class="row">
	<div class="col-auto mr-auto">
		<h2>Daftar Jurusan</h2>
	</div>
	<div class="col-auto">
		<button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#tambahJurusan">Tambah Jurusan</button>
	</div>
</div>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col-6">ID</th>
			<th scope="col">Nama Jurusan</th>
			<th scope="col">Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $jurusan)
		<tr>
			<th scope="col">{{ $jurusan['id'] }}</th>
			<td>{{ $jurusan['nama'] }}</td>
			<td>
				<button class="btn btn-success" data-toggle="modal" data-target="#editJurusan{{$jurusan['id']}}">Edit</button>
				<button class="btn btn-danger" data-toggle="modal" data-target="#hapusJurusan{{$jurusan['id']}}">Hapus</button>
			</td>
		</tr>

		<!-- Modal Edit Jurusan -->
		<div class="modal fade" id="editJurusan{{$jurusan['id']}}" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Jurusan</h5>
						<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{url('admin/jurusan/edit')}}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="nama">Nama Jurusan</label>
								<input type="text" class="form-control" id="nama" name="nama" value="{{$jurusan['nama']}}">
								<input type="hidden" name="id" value="{{$jurusan['id']}}">
							</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit">Edit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Hapus Jurusan -->
		<div class="modal fade" id="hapusJurusan{{$jurusan['id']}}" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Anda Yakin?</h5>
						<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<p>Anda yakin akan menghapus jurusan <strong>{{$jurusan['nama']}}</strong>?</p>
						<form action="{{url('admin/jurusan/hapus')}}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="id" value="{{$jurusan['id']}}">
							</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" type="submit">Hapus</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</tbody>
</table>

<!-- Modal add Activity -->
<div class="modal fade" id="tambahJurusan" tabindex="-1" role="dialog" aria-labelledby="tambahJurusanLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahJurusanLabel">Tambah Jurusan</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ url('admin/jurusan/tambah') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nama">Nama Jurusan</label>
						<input type="text" class="form-control" id="nama" name="nama">
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop