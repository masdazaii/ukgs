<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

  <!-- Sidebar mobile toggler -->
  <div class="sidebar-mobile-toggler text-center">
    <a href="#" class="sidebar-mobile-main-toggle">
      <i class="icon-arrow-left8"></i>
    </a>
    <span class="font-weight-semibold">Navigation</span>
    <a href="#" class="sidebar-mobile-expand">
      <i class="icon-screen-full"></i>
      <i class="icon-screen-normal"></i>
    </a>
  </div>
  <!-- /sidebar mobile toggler -->


  <!-- Sidebar content -->
  <div class="sidebar-content">

    <!-- User menu -->
    {{-- <div class="sidebar-user-material">
      <div class="sidebar-user-material-body">
        <div class="card-body text-center">
          <a href="#">
            <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
          </a>
          <h6 class="mb-0 text-white text-shadow-dark">{{ Auth::user()->name }}</h6>
        </div>
                      
        <div class="sidebar-user-material-footer">
          <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
        </div>
      </div>

      <div class="collapse" id="user-nav">
        <ul class="nav nav-sidebar">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="icon-user-plus"></i>
              <span>My profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="icon-coins"></i>
              <span>My balance</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="icon-comment-discussion"></i>
              <span>Messages</span>
              <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="icon-cog5"></i>
              <span>Account settings</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="icon-switch2"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div> --}}
    <!-- /user menu -->


    <!-- Main navigation -->
    <div class="card card-sidebar-mobile">
      <ul class="nav nav-sidebar" data-nav-type="accordion">

        <!-- Main -->
        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
        <li class="nav-item">
          <a href="{{ URL::to('/') }}" class="nav-link">
            <i class="icon-home4"></i>
            <span>
              Dashboard
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ URL::to('/sekolah') }}" class="nav-link"><i class="icon-graduation2"></i> <span>Data Sekolah</span></a>
        </li>
        <li class="nav-item">
          <a href="{{ URL::to('/kelurahan') }}" class="nav-link"><i class="icon-location3"></i> <span>Data Kelurahan</span></a>
        </li>
        <li class="nav-item nav-item-submenu">
          <a href="#" class="nav-link"><i class="icon-accessibility"></i> <span>Pemeriksaan</span></a>
          <ul class="nav nav-group-sub" data-submenu-title="Layouts">
            <li class="nav-item"><a href="{{ URL::to('/pemeriksaanGigi') }}" class="nav-link">Pemeriksaan Gigi</a></li>
            <li class="nav-item"><a href="{{ URL::to('/pemeriksaanImt') }}" class="nav-link">Pemeriksaan IMT</a></li>
            <li class="nav-item"><a href="{{ URL::to('/pemeriksaanSosial') }}" class="nav-link">Pemeriksaan Sosial</a></li>
            <li class="nav-item"><a href="{{ URL::to('/pemeriksaanPtm') }}" class="nav-link">Pemeriksaan Penyakit Tidak Menular</a></li>
            <li class="nav-item"><a href="{{ URL::to('/pemeriksaanBw') }}" class="nav-link">Pemeriksaan Buta Warna</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ URL::to('/rujukan') }}" class="nav-link"><i class="icon-googleplus5"></i> <span>Rujukan</span></a>
        </li>
        <li class="nav-item">
          <a href="{{ URL::to('/user') }}" class="nav-link"><i class="icon-users"></i><span>Data Pengguna</span></a>
        </li>
      </ul>
    </div>
    <!-- /main navigation -->

  </div>
  <!-- /sidebar content -->
  
</div>
<!-- /main sidebar -->