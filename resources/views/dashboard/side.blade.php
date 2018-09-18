<div class="col-md-2">
	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: #34495e; border-radius: 5px; min-height: 420px;">
		<a href="{{url('dashboard')}}" class="nav-link  @if (!empty($halaman) && $halaman=='dashboard') {{'active'}} @endif"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
		<a href="{{url('activity')}}" class="nav-link  @if (!empty($halaman) && $halaman=='kegiatan') {{'active'}} @endif"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Daftar Kegiatan</a>
		<a href="{{url('activity/submit')}}" class="nav-link  @if (!empty($halaman) && $halaman=='submit kegiatan') {{'active'}} @endif"><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Submit Kegiatan</a>
		<a href="#progresBulananMenu" class="nav-link  @if (!empty($halaman) && $halaman=='bulanan') {{'active'}} @endif"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;&nbsp;Progres Bulanan</a>
	</div>
</div>