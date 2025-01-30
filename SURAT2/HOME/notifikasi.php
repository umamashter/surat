<?php if ($_SESSION['akses'] == 'Pimpinan') { ?>
<?php
$query = "SELECT * FROM tb_sk WHERE status = '2'";
$result = $koneksi->query($query);

$notification_count = $result->num_rows;

$row = $result->fetch_assoc();
$tanggal = $row["tgl_sk"] ?? null;
$tanggal_sk = date("F d, Y", strtotime($tanggal));
?>
<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="NOTIF SURAT KELUAR">
    <i class="fas fa-envelope-open fa-fw"></i>
    <?php if ($notification_count > 0): ?>
      <span class="badge badge-danger badge-counter"><?php echo $notification_count; ?></span>
    <?php endif; ?>
  </a>
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
      SURAT KELUAR
    </h6>
    <a class="dropdown-item d-flex align-items-center" href="pimpinan_keluar.php">
      <?php if ($notification_count > 0) { ?>
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-envelope-open text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500"><?php echo $tanggal_sk; ?></div>
          <span class="font-weight-bold">Pimpinan Mohon Periksa Surat Keluar dari nomor surat <?php echo $row['nomor_sk'] ?? null; ?></span>
        </div>
      <?php }else { ?>
        <span class="font-weight-bold">Tidak Ada Notif Surat Keluar</span>
      <?php } ?>
    </a>
  </div>
</li>
<?php }elseif ($_SESSION['akses'] == 'Sekretaris') { ?>

<?php
$query = "SELECT * FROM tb_sk WHERE status = '1'";
$result = $koneksi->query($query);

$notification_count = $result->num_rows;

$row = $result->fetch_assoc();
$tanggal = $row["tgl_sk"] ?? null;
$tanggal_sk = date("F d, Y", strtotime($tanggal));
?>
<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="NOTIF SURAT KELUAR">
    <i class="fas fa-envelope-open fa-fw"></i>
    <?php if ($notification_count > 0): ?>
      <span class="badge badge-danger badge-counter"><?php echo $notification_count; ?></span>
    <?php endif; ?>
  </a>
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
      SURAT KELUAR
    </h6>
    <a class="dropdown-item d-flex align-items-center" href="umum_keluar.php">
      <?php if ($notification_count > 0) { ?>
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-envelope-open text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500"><?php echo $tanggal_sk; ?></div>
          <span class="font-weight-bold">Mohon Periksa Surat Keluar dari nomor surat <?php echo $row['nomor_sk'] ?? null; ?></span>
        </div>
      <?php }else{ ?>
        <span class="font-weight-bold">Tidak Notif Surat Keluar</span>
      <?php } ?>
    </a>
  </div>
</li>
<?php }elseif ($_SESSION['akses'] == 'Petugas') { ?>

<?php
$idp = $_SESSION['pengguna'];
$query = "SELECT * FROM tb_sk WHERE status IN ('1', '2', '3', '0', '4') AND dari_disposisi = '$idp'";
$result = $koneksi->query($query);

$notification_count = $result->num_rows;

$row = $result->fetch_assoc();
$tanggal = $row["tgl_sk"] ?? null;
$tanggal_sk = date("F d, Y", strtotime($tanggal));
?>
<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="NOTIF SURAT KELUAR">
    <i class="fas fa-envelope-open fa-fw"></i>
    <?php if ($notification_count > 0): ?>
      <span class="badge badge-danger badge-counter"><?php echo $notification_count; ?></span>
    <?php endif; ?>
  </a>
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">
      SURAT KELUAR
    </h6>
    <a class="dropdown-item d-flex align-items-center" href="surat_keluar_p.php">
      <?php if ($notification_count > 0) { ?>
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas fa-envelope-open text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500"><?php echo $tanggal_sk; ?></div>
          <span class="font-weight-bold">
            <?php if ($row['status'] == 1) { ?>
              Nomor surat keluar <?php echo $row['nomor_sk'] ?? null; ?> Masih Proses Pengecekan.
            <?php }elseif ($row['status'] == 2) { ?>
              Nomor surat keluar <?php echo $row['nomor_sk'] ?? null; ?> Masih Dicek Pimpinan.
            <?php }elseif ($row['status'] == 3) { ?>
              Nomor surat keluar <?php echo $row['nomor_sk'] ?? null; ?> Bekas Siap Dikirim.
            <?php }elseif ($row['status'] == 0) { ?>
              Nomor surat keluar <?php echo $row['nomor_sk'] ?? null; ?> Dicek Ulang.
            <?php }elseif ($row['status'] == 4) { ?>
              Nomor surat keluar <?php echo $row['nomor_sk'] ?? null; ?> Perbaiki.
            <?php } ?>
          </span>
        </div>
      <?php }else{ ?>
        <span class="font-weight-bold">Tidak Notif Surat Keluar</span>
      <?php } ?>
    </a>
  </div>
</li>
<?php } ?>

<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="NOTIF SURAT MASUK">
    <i class="fas fa-envelope fa-fw"></i>
    <span class="badge badge-warning badge-counter">2</span>
  </a>
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
      SURAT MASUK
    </h6>
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
        <div class="status-indicator bg-success"></div>
      </div>
      <div class="font-weight-bold">
        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
        <div class="small text-gray-500">Udin Cilok · 58m</div>
      </div>
    </a>
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
        <div class="status-indicator bg-default"></div>
      </div>
      <div>
        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
        <div class="small text-gray-500">Jaenab · 2w</div>
      </div>
    </a>
    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
  </div>
</li>