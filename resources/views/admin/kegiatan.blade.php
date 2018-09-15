@extends('admin.template')

@section('main')
@csrf
<div class="row">
	<div class="col-auto mr-auto">
		<h2>Daftar Kegiatan</h2>
	</div>
	<div class="col-auto">
		<button type="bu'" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addActivity">Tambah Kegiatan</button>
	</div>
</div>

<table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col-6">No</th>
			<th scope="col">Nama Kegiatan</th>
			<th scope="col">Kategori</th>
			<th scope="col">Jumlah</th>
			<th scope="col">Satuan</th>
			<th scope="col">Pilihan</th>
		</tr>
	</thead>
</table>

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
				<form action="{{ url('dashboard/tambah') }}" method="post">
					{{ csrf_field() }}
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="nama">Nama Kegiatan</label>
							<input type="text" class="form-control" id="nama" name="nama" aria-describedby="namaHelp">
							<small id="namaHelp" class="form-text text-muted">*) Contoh : Hafalan Al-Qur'an</small>
						</div>
						<div class="form-group col-md-8">
							<label for="kategori">Kategori</label>
							<input type="text" class="form-control" id="kategori" name="kategori">
						</div>
						<div class="form-group col-md-2">
							<label for="jumlah">Jumlah</label>
							<input type="text" class="form-control" id="jumlah" name="jumlah" aria-describedby="jumlahHelp">
							<small id="jumlahHelp" class="form-text text-muted">5</small>
						</div>
						<div class="form-group col-md-2">
							<label for="satuan">Satuan</label>
							<input type="text" class="form-control" id="satuan" name="satuan" aria-describedby="satuanHelp">
							<small id="satuanHelp" class="form-text text-muted">Ayat</small>
						</div>
						<div class="form-group">
							<label for="waktu">Pilih Hari</label> <br>
							<a href="javascript:pilihSemua()">Pilih Semua</a> &nbsp;&nbsp;
							<a href="javascript:bersihkan()">Hapus Semua</a> <br>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Senin" value="senin" name="hari[]">
								<label class="form-check-label" for="Senin">Senin</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Selasa" value="selasa" name="hari[]">
								<label class="form-check-label" for="Selasa">Selasa</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Rabu" value="rabu" name="hari[]">
								<label class="form-check-label" for="Rabu">Rabu</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Kamis" value="kamis" name="hari[]">
								<label class="form-check-label" for="Kamis">Kamis</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Jumat" value="jumat" name="hari[]">
								<label class="form-check-label" for="Jumat">Juma'at</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Sabtu" value="sabtu" name="hari[]">
								<label class="form-check-label" for="Sabtu">Sabtu</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="checkbox" class="form-check-input" id="Minggu" value="minggu" name="hari[]">
								<label class="form-check-label" for="Minggu">Minggu</label>
							</div>
						</div>
					</div>
					<script>
						function pilihSemua()
						{
							var daftarku = document.getElementsByName("hari[]");
							var jml=daftarku.length;
							var b=0;
							for (b=0;b<jml;b++)
							{
								daftarku[b].checked=true;
								
							}
						}
						function bersihkan()
						{
							var daftarku = document.getElementsByName("hari[]");
							var jml=daftarku.length;
							var b=0;
							for (b=0;b<jml;b++)
							{
								daftarku[b].checked=false;
								
							}
						}
					</script>
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