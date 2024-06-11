<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      @if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'dekan')
        <span class="brand-text font-weight-light">Peminjaman Ruangan dan Barang</span>
      @endif
      @if (Auth::user()->role->name == 'rumah tangga')
        <span class="brand-text font-weight-light">Peminjaman Barang</span>
      @endif
      @if (Auth::user()->role->name == 'perkuliahan')
        <span class="brand-text font-weight-light">Peminjaman Ruangan</span>
      @endif

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->role->name }})</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @if ((Auth::user()->role->name == 'admin'))
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.ruangan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.barang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjaman.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjamanbarang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.user.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.denah.index')}}" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Denah
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
      @if ((Auth::user()->role->name == 'dekan'))
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.ruangan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.barang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjaman.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjamanbarang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Denah
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
      @if ((Auth::user()->role->name == 'rumah tangga'))
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.barang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjamanbarang.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Denah
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
      @if ((Auth::user()->role->name == 'perkuliahan'))
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.ruangan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Ruangan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboardpage.peminjaman.index')}}" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Peminjaman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Denah
              </p>
            </a>
          </li>
        </ul>
      </nav>
      @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
