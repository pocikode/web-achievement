@extends('admin.template')

@section('main')
@csrf
<div class="row">
	<div class="col-auto mr-auto">
		<h2>Daftar Santri</h2>
	</div>
	<div class="col-auto">
		<button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#tambahSantri">Tambah Santri</button>
	</div>
</div>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col-6">ID</th>
			<th scope="col">Nama Santri</th>
			<th scope="col">User</th>
			<th scope="col">Jurusan</th>
			<th scope="col">Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($dataSantri as $santri)
		<tr>
			<th scope="col">{{$santri['id']}}</th>
			<td>{{$santri['nama']}}</td>
			<td>{{$santri['user']}}</td>
			<td></td>
			<td>
				<button class="btn btn-success" data-toggle="modal" data-target="#updateSantri{{$santri['id']}}">Update</button>
				<button class="btn btn-danger" data-toggle="modal" data-target="#hapusSantri{{$santri['id']}}">Hapus</button>
			</td>
		</tr>

		<!-- Modal Tambah Santri -->
		<div class="modal fade" id="updateSantri{{$santri['id']}}" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Update Data Santri</h5>
						<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form method="post" action="{{ url('admin/santri/update') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="nama">Nama Santri</label>
								<input type="text" class="form-control" id="nama" name="nama" value="{{$santri['nama']}}">
							</div>
							<div class="form-group">
								<label for="user">Username</label>
								<input type="text" class="form-control" id="user" name="user" value="{{$santri['user']}}">
							</div>
							<div class="form-group">
								<label for="jurusan">Jurusan</label>
								<select name="jurusan" id="jurusan" class="form-control">
									<option> ----- Pilih Jurusan ----- </option>
									@foreach($data as $jurusan)
									<option value="{{ $jurusan['id'] }}">{{$jurusan['nama']}}</option>
									@endforeach
								</select>
								<input type="hidden" name="id" value="{{$santri['id']}}">
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
		<!-- Modal Hapus Santri -->
		<div class="modal fade" id="hapusSantri{{$santri['id']}}" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Anda Yakin?</h5>
						<button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<p>Anda yakin akan menghapus <strong>{{$santri['nama']}}</strong>?</p>
						<form action="{{url('admin/santri/hapus')}}" method="post">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="hidden" name="id" value="{{$santri['id']}}">
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
<div class="modal fade" id="tambahSantri" tabindex="-1" role="dialog" aria-labelledby="tambahSantriLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahSantriLabel">Tambah Santri</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ url('admin/santri/tambah') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nama">Nama Santri</label>
						<input type="text" class="form-control" id="nama" name="nama">
					</div>
					<div class="form-group">
						<label for="user">Username</label>
						<input type="text" class="form-control" id="user" name="user">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password">
					</div>
					<div class="form-group">
						<label for="jurusan">Jurusan</label>
						<select name="jurusan" id="jurusan" class="form-control">
							<option> ----- Pilih Jurusan ----- </option>
							@foreach($data as $jurusan)
							<option value="{{ $jurusan['id'] }}">{{$jurusan['nama']}}</option>
							@endforeach
						</select>
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