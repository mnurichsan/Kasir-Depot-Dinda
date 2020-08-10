 <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('home')}}">Depot Dinda</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('home')}}">Dinda</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{route('home')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-boxes"></i><span>Barang</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('barang.index')}}">Data Barang</a></li>
              </ul>
            </li>
             <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i><span>Pegawai</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('pegawai.index')}}">Data Pegawai</a></li>
              </ul>
            </li>
            <li class="menu-header">POS Data</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-donate"></i><span>Setoran</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('setoran.index')}}">Data Setoran</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-file"></i><span>Data POS</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('setoran.laporan')}}">Setoran</a></li>
                <li><a class="nav-link" href="{{route('transaksi.laporan')}}">Transaksi</a></li>
              </ul>
            </li>
            <li class="menu-header">User Management</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>User</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('user.index')}}">Data User</a></li>
              </ul>
            </li>
            <li class="menu-header">Aplikasi</li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>About Us</span></a></li>
           </aside>
      </div>