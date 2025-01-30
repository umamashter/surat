  <?php if ($_SESSION['akses'] == 'Admin') { ?>    
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['jabatan']; ?></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manajamen Surat
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data</h6>
            <a class="collapse-item" href="arsip.php">Arsip Surat</a>
            <a class="collapse-item" href="disposisi.php">Disposisi</a>
            <a class="collapse-item" href="kategori.php">Kategori Surat</a>
            <!--<a class="collapse-item" href="profil.php">Profil</a>-->
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_masuk.php">
          <i class="fas fa-envelope"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="Surat_keluar.php">
          <i class="fas fa-envelope-open"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pengguna.php">
          <i class="fas fa-users"></i>
          <span>Pengguna</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Lainnya
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
          aria-controls="collapsePage">
          <i class="fas fa-file-pdf"></i>
          <span>Laporan</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Laporan Surat</h6>
            <a class="collapse-item" href="lap_masuk.php">Laporan Surat Masuk</a>
            <a class="collapse-item" href="lap_keluar.php">Laporan Surat Keluar</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="keluar.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
  <?php }elseif ($_SESSION['akses'] == 'Pimpinan') { ?>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['jabatan']; ?></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manajamen Surat
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pimpinan_surat.php">
          <i class="fas fa-envelope"></i>
          <span>Periksa Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pimpinan_keluar.php">
          <i class="fas fa-envelope-open"></i>
          <span>Periksa Surat Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_masuk_p.php">
          <i class="fas fa-envelope"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_keluar_p.php">
          <i class="fas fa-envelope-open"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="histori.php">
          <i class="fas fa-history"></i>
          <span>History</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="keluar.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
  <?php }elseif ($_SESSION['akses'] == 'Sekretaris') { ?>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['jabatan']; ?></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manajamen Surat
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="umum_surat.php">
          <i class="fas fa-envelope"></i>
          <span>Periksa Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="umum_keluar.php">
          <i class="fas fa-envelope-open"></i>
          <span>Periksa Surat Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_masuk_p.php">
          <i class="fas fa-envelope"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_keluar_p.php">
          <i class="fas fa-envelope-open"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="histori.php">
          <i class="fas fa-history"></i>
          <span>History</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="keluar.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <?php }elseif ($_SESSION['akses'] == 'Petugas') { ?>
      <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $_SESSION['jabatan']; ?></div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Manajamen Surat
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="surat_masuk_p.php">
          <i class="fas fa-envelope"></i>
          <span>Surat Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="Surat_keluar_p.php">
          <i class="fas fa-envelope-open"></i>
          <span>Surat Keluar</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Lainnya
      </div>
      <li class="nav-item">
        <a class="nav-link" href="keluar.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <?php } ?>