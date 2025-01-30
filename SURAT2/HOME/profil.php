<?php 
$idp = $_SESSION['pengguna'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE id_pg = '$idp'");
$row = mysqli_fetch_assoc($data);
?>
<li class="nav-item dropdown no-arrow">
  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img class="img-profile rounded-circle" src="pengguna/<?php echo $row['foto']; ?>" style="max-width: 60px">
    <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $row['nama_lengkap']; ?></span>
  </a>
  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="identitas.php">
      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
      Profile
    </a>
    <a class="dropdown-item" href="#">
      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
      Settings
    </a>
    <a class="dropdown-item" href="#">
      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
      Activity Log
    </a>
    <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
  </div>
</li>