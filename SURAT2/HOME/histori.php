<?php 
session_start();
include 'koneksi.php';
// Periksa apakah session username telah diatur
if (!isset($_SESSION['pengguna_type'])) {
    echo '<script language="javascript" type="text/javascript">
    alert("Anda Tidak Berhak Masuk Kehalaman Ini!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Surat - Data History Surat</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include 'menu.php'; ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!--<?php include 'notifikasi.php'; ?>-->
            <div class="topbar-divider d-none d-sm-block"></div>
            <?php include 'profil.php'; ?>
          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data History</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item">History</li>
              <li class="breadcrumb-item active" aria-current="page">Data History</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data History</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>Tgl. Terima</th>
                        <th>Perihal</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;

                      $data = mysqli_query($koneksi, "SELECT * FROM tb_sm");
                      while ($row = mysqli_fetch_assoc($data)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo $row['tgl_surat']; ?></td>
                        <td><?php echo $row['perihal_surat']; ?></td>
                        <td>
                          <?php if ($row['status'] == 1) { ?>
                            <span class="badge badge-primary"><i class="fas fa-spinner"></i> Proses</span>
                          <?php }elseif ($row['status'] == 2) { ?>
                            <span class="badge badge-warning"><i class="fas fa-paper-plane"></i> Diajukan</span>
                          <?php }elseif ($row['status'] == 3) { ?>
                            <span class="badge badge-success"><i class="fas fa-check"></i> Selesai Disposisi</span>
                          <?php } ?>
                        </td>
                        <td>
                          <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#detailSuratModal<?php echo $row['id_sm']; ?>"><i class="fas fa-eye"></i> Detail</a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal -->
          <?php 
          $surat = "SELECT * FROM tb_sm, tb_kategori WHERE id_kategori=kategori";
          $results = mysqli_query($koneksi, $surat);
          while ($rows = mysqli_fetch_assoc($results)){
            $ids = $rows['id_sm']; 
          ?>
          <div class="modal fade" id="detailSuratModal<?php echo $rows['id_sm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Detail Surat</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <!-- Isi Tabel Detail Surat -->
                          <table class="table">
                              <tbody>
                                  <tr>
                                      <th>Tgl. Surat Masuk</th>
                                      <td><?php echo $rows['tgl_sm']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Nomor Agenda</th>
                                      <td><?php echo $rows['nomor_agenda']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Kode Surat</th>
                                      <td><?php echo $rows['kode_sm']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Nomor Surat</th>
                                      <td><?php echo $rows['nomor_sm']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Tanggal Surat</th>
                                      <td><?php echo $rows['tgl_surat']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Kategori Surat</th>
                                      <td><?php echo $rows['nama_kategori_s']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Pengirim</th>
                                      <td><?php echo $rows['pengirim']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Perihal Surat</th>
                                      <td><?php echo $rows['perihal_surat']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Lampiran</th>
                                      <td><?php echo $rows['lampiran']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Status Surat</th>
                                      <td>
                                        <?php if ($rows['status'] == 1) { ?>
                                          <span class="badge badge-primary"><i class="fas fa-spinner"></i> Proses</span>
                                        <?php }elseif ($rows['status'] == 2) { ?>
                                          <span class="badge badge-warning">Dibaca</span>
                                        <?php }elseif ($rows['status'] == 3) { ?>
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Selesai Disposisi</span>
                                        <?php } ?> 
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Disposisi Ke</th>
                                      <td>
                                        <?php if (empty($rows['disposisi'])) { ?>
                                          <span><em><b>Belum ada disposisi</b></em></span>
                                        <?php }else{ ?>
                                          <span><?php echo $rows['disposisi']; ?></span> 
                                          <?php if ($rows['status_baca'] == 0) { ?>
                                            <br>
                                            <span class="badge badge-primary"><i class="fas fa-spinner"></i> Masih Tahap Proses Baca Dari Bagian Disposisi</span>
                                          <?php }elseif ($rows['status_baca'] == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i> Sudah Dibaca Dari Bagian Disposisi</span>
                                          <?php } ?>
                                        <?php } ?>
                                      </td>
                                  </tr>
                                  <?php 
                                  $dispo = "SELECT * FROM tb_disposisi WHERE sm_id='$ids'";
                                  $resultd = mysqli_query($koneksi, $dispo);
                                  $rowd = mysqli_fetch_assoc($resultd);
                                  ?>
                                  <tr>
                                      <th>Tujuan Disposisi</th>
                                      <td>
                                        <?php if (empty($rowd['tujuan_disposisi'])) { ?>
                                          <span><em><b>Belum ada tujuan disposisi</b></em></span>
                                        <?php }else{ ?>
                                          <span><?php echo $rowd['tujuan_disposisi']; ?></span>
                                        <?php } ?>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Catatan</th>
                                      <td>
                                        <?php if (empty($rowd['catatan'])) { ?>
                                          <span><em><b>Belum ada catatan</b></em></span>
                                        <?php }else{ ?>
                                          <span><?php echo $rowd['catatan']; ?></span>
                                        <?php } ?>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      </div>
                  </div>
              </div>
          </div>
          <?php } ?>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>