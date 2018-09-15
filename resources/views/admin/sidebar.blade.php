<!-- Sidebar -->
<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="{{url('admin')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('admin/santri') }}" class="nav-link">
      <i class="fas fa-fw fa-user"></i>
      <span>Data Santri</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-table"></i>
      <span>Kegiatan</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="{{ url('admin/kegiatan') }}">Daftar Kegiatan</a>
      <a class="dropdown-item" href="{{ url('admin/kategori') }}">Kategori Kegiatan</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('admin/jurusan') }}">
      <i class="fas fa-fw fa-chalkboard"></i>
      <span>Jurusan</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li>
</ul>