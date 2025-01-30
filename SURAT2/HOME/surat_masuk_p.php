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
  <title>Surat Masuk Petugas - Data Surat Masuk</title>
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
            <h1 class="h3 mb-0 text-gray-800">Data Surat Masuk <?php echo $_SESSION['jabatan']; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"> Surat Masuk <?php echo $_SESSION['jabatan']; ?></li>
              <li class="breadcrumb-item active" aria-current="page">Data Surat Masuk <?php echo $_SESSION['jabatan']; ?></li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Surat Masuk <?php echo $_SESSION['jabatan']; ?></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>No. Agenda</th>
                        <th>No. Surat Masuk</th>
                        <th>Pengirim</th>
                        <th>Tujuan Disposisi</th>
                        <th>Berkas</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $nama = $_SESSION['nama']; 
                      $no = 1;

                      $data = mysqli_query($koneksi, "SELECT * FROM tb_sm, tb_disposisi WHERE sm_id = id_sm AND disposisi = '$nama' ORDER BY id_sm DESC");
                      while ($row = mysqli_fetch_assoc($data)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo $row['nomor_agenda']; ?></td>
                        <td><?php echo $row['nomor_sm']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['tujuan_disposisi']; ?></td>
                        <td>
                          <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#fileModal<?php echo $row['id_sm']; ?>"><i class="fas fa-file-pdf"></i> File Pdf</a>
                        </td>
                        <td>
                          <?php if ($row['status_baca'] == 0) { ?>
                            <a class="btn btn-sm btn-warning" href="berkas.php?id=<?php echo $row['id_sm']; ?>">Terima Berkas</a>
                          <?php }elseif ($row['status_baca'] == 1) { ?>
                            <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#detailModal<?php echo $row['id_sm']; ?>">Berkas Diterima dan Lihat Detail</a>
                          <?php } ?>
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

          <!-- Modal File Pdf -->
          <?php 
          $surat = "SELECT * FROM tb_sm";
          $results = mysqli_query($koneksi, $surat);
          while ($rows = mysqli_fetch_assoc($results)){
            $idsm = $rows['id_sm'];
          ?>
          <div class="modal fade" id="fileModal<?php echo $idsm; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">File Surat Masuk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                    <?php 
                    $dataf = "SELECT * FROM file_surat WHERE surat_id='$idsm'";
                    $result = mysqli_query($koneksi, $dataf);
                    while ($rowf = mysqli_fetch_assoc($result)){
                      $berkas_pdf = $rowf['nama_file'];
                    ?>
                    <iframe src="suratmasuk/<?php echo $berkas_pdf; ?>" style="width: 100%; height: 500px;"></iframe><br>
                    <a href="suratmasuk/<?php echo $berkas_pdf; ?>" class="btn btn-primary" download><i class="fas fa-file-pdf"></i> Unduh PDF</a><br>
                    <hr>
                    <?php } ?>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

          <!-- Modal -->
          <?php 
          $surat = "SELECT * FROM tb_sm, tb_kategori, tb_disposisi WHERE id_kategori=kategori AND sm_id = id_sm";
          $results = mysqli_query($koneksi, $surat);
          while ($rows = mysqli_fetch_assoc($results)){
            $ids = $rows['id_sm']; 
          ?>
          <div class="modal fade" id="detailModal<?php echo $rows['id_sm']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <td><?php echo $rows['tgl_surat']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Nomor Agenda</th>
                                      <td><?php echo $rows['nomor_agenda']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Kode Surat Masuk</th>
                                      <td><?php echo $rows['kode_sm']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Nomor Surat</th>
                                      <td><?php echo $rows['nomor_sm']; ?></td>
                                  </tr>
                                  <tr>
                                      <th>Tanggal Surat</th>
                                      <td><?php echo $rows['tgl_sm']; ?></td>
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
                                        <?php if ($rows['status'] == 3) { ?>
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
                              </tbody>
                          </table>
                          <?php 
                          $query = mysqli_query($koneksi,"SELECT catatan FROM tb_disposisi WHERE catatan LIKE '%Arsip%' AND sm_id = '$ids'");
                          $d = mysqli_fetch_assoc($query);
                          $arsip = $d['catatan'] ?? null;
                          ?>
                          <?php if ($arsip) { ?>
                            <?php if ($rows['status_dispo'] == 0) { ?>
                            <hr>
                            <form method="POST" action="proses_arsip.php">
                              <input type="hidden" name="ids" value="<?php echo $rows['id_sm']; ?>">
                              <div class="form-group">
                                <label for="">Pilih Lokasi Arsip</label>
                                <select class="form-control" name="arsip">
                                  <option selected disabled>Pilih Lokasi Arsip</option>
                                  <option value="Rak 1">Rak 1</option>
                                  <option value="Rak 2">Rak 2</option>
                                  <option value="Rak 3">Rak 3</option>
                                </select>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Arsip Berkas</button>
                              </div>
                            </form>
                          <?php }elseif ($rows['status_dispo'] == 1) { ?>
                            <center><span class="badge badge-success"><i class="fas fa-check"></i> Berkas Sudah Diarsip</span></center>
                          <?php } ?>
                        <?php } ?>
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
                  <a href="keluar.php" class="btn btn-primary">Logout</a>
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
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script>
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