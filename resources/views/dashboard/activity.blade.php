@extends('template')

@section('main')
<div class="row main">
	{{-- SIDE MENU --}} 
	@include('dashboard.side')

	<div class="col-md-10">
		@csrf

		@if (session('error'))
			<div class="alert alert-danger">{{session('error')}}</div>
		@endif
		<div class="row">
			<div class="col-auto mr-auto">
				<h2>Daftar Kegiatan</h2>
			</div>
			<div class="col-auto">
				<button  class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addActivity">Tambah Kegiatan</button>
			</div>
		</div>
		
		<table class="table" id="tabelKegiatan">
			<thead class="thead-light">
				<tr>
					<th scope="col-6">No</th>
					<th scope="col">Nama Kegiatan</th>
					<th scope="col">Kategori</th>
					<th scope="col">Jumlah</th>
					<th scope="col" width="17%">Pilihan</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($kegiatan as $data)
				<tr>
					<th scope="col">{{$no}}</th>
					<td>{{$data['nama']}}</td>
					@php
						$kat = DB::table('categories')->where('id', $data['kategori'])->value('nama');
					@endphp
					<td>{{$kat}}</td>
					<td>{{$data['jumlah']}}</td>
					<td>
						<button class="btn btn-success" data-toggle="modal" data-target="#updateKegiatan{{$data['id']}}">Update</button>
						<button class="btn btn-warning" data-toggle="modal" data-target="#hapusKegiatan{{$data['id']}}">Delete</button>
					</td>
					@php $no++ @endphp			
				</tr>
				
				<!-- Modal Update Kegiatan -->
				<div class="modal fade" id="updateKegiatan{{$data['id']}}" role="dialog" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Update Kegiatan</h5>
							</div>
							<div class="modal-body">
								<form action="{{ route('activity.update', $data['id'] )}}" method="post">
									{{ csrf_field() }}
									@method('PUT')
									<div class="form-row">
										<div class="form-group col-md-10">
											<label for="nama">Nama Kegiatan</label>
											<input type="text" class="form-control" id="nama" name="nama" aria-describedby="namaHelp" value="{{$data['nama']}}">
											<small id="namaHelp" class="form-text text-muted">*) Contoh : Hafalan Al-Qur'an</small>
										</div>
										<div class="form-group	col-2">
											<label for="jumlah">Jumlah</label>
											<input type="text" class="form-control" id="jumlah" name="jumlah" aria-describedby="jumlahHelp" value="{{$data['jumlah']}}">
											<small id="jumlahHelp" class="form-text text-muted">5hal</small>
										</div>
										<div class="form-group col-12">
											<label for="kategori">Kategori</label>
											<select name="kategori" id="kategori" class="form-control">
												<option value="0"> ----- Pilih Kategori ----- </option>
												@foreach ($kategori as $kat)
												<option value="{{$kat['id']}}" >{{$kat['nama']}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<input type="hidden" name="id" value="{{$data['id']}}">
							</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Hapus Kegiatan -->
				<div class="modal fade" id="hapusKegiatan{{$data['id']}}" role="dialog" aria-hidden="true" style="width: 250px; margin: 0 auto;">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<h5 class="modal-title text-center">Apakah Anda Yakin?</h5> <br>
								<div style="width: 120px; margin: 0 auto;">
									<form action="{{ route('activity.destroy', $data['id'] )}}" method="post">
										{{ csrf_field() }}
										@method('DELETE')
										<input type="hidden" name="id" value="{{$data['id']}}">
										<button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
										<button class="btn btn-danger" type="submit">Ya</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</tbody>
		</table>

	</div>
</div>




<!-- Modal add Activity -->
<div class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="addActivityLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addActivityLabel">Tambah Kegiatan</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="form-row">
						<div class="form-group col-md-10">
							<label for="nama">Nama Kegiatan</label>
							<input type="text" class="form-control" id="nama" name="nama" aria-describedby="namaHelp" required>
							<small id="namaHelp" class="form-text text-muted">*) Contoh : Hafalan Al-Qur'an</small>
						</div>
						<div class="form-group	col-2">
							<label for="jumlah">Jumlah</label>
							<input type="text" class="form-control" id="jumlah" name="jumlah" aria-describedby="jumlahHelp" required>
							<small id="jumlahHelp" class="form-text text-muted">5hal</small>
						</div>
						<div class="form-group col-12">
							<label for="kategori">Kategori</label>
							<select name="kategori" id="kategori" class="form-control">
								<option value="0"> ----- Pilih Kategori ----- </option>
								@foreach ($kategori as $kat)
								<option value="{{$kat['id']}}">{{$kat['nama']}}</option>
								@endforeach
							</select>
						</div>
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