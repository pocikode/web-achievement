<div class="col-md-2">
	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: #34495e; border-radius: 5px; min-height: 420px;">
		@if(Auth::user()->level == 'admin')
			<p>Ini Admin</p>
		@else
		<a href="{{url('dashboard')}}" class="nav-link  @if (!empty($halaman) && $halaman=='dashboard') {{'active'}} @endif"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
		<a href="{{url('activity')}}" class="nav-link  @if (!empty($halaman) && $halaman=='kegiatan') {{'active'}} @endif"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Daftar Kegiatan</a>
		<a href="{{url('partner')}}" class="nav-link  @if (!empty($halaman) && $halaman=='partner') {{'active'}} @endif"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;Partner</a>
		<a href="#progresBulananMenu" class="nav-link  @if (!empty($halaman) && $halaman=='bulanan') {{'active'}} @endif"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;&nbsp;Progres Bulanan</a>
		@endif
	</div>
</div>