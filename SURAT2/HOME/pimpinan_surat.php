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

$data = "SELECT * FROM tb_ajukan";
$result = mysqli_query($koneksi, $data);
$rowa = mysqli_fetch_assoc($result);
$id = $rowa['pg_id'];
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
  <title>Surat - Data Surat Masuk</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

  <style>
    .modal-form .modal-left,
    .modal-form .modal-right {
      width: 48%; /* Adjust the width as needed */
    }

    .select2-container {
      width: 100% !important;
    }

    .select2-selection {
      width: 100% !important;
    }

    .select2-dropdown {
      width: 34% !important;
    }
  </style>
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
            <h1 class="h3 mb-0 text-gray-800">Data Surat Masuk</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Data Surat Masuk</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Surat Masuk</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>No.Agenda</th>
                        <th>No. Surat Masuk</th>
                        <th>Tgl. Surat Masuk</th>
                        <th>Kategori Surat</th>
                        <th>Pengirim</th>
                        <th>Lampiran</th>
                        <th>Status Surat</th>
                        <th>Berkas</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //membuat nomor halaman data
                      $no=1;

                      //data surat masuk 
                      $data = "SELECT * FROM tb_sm, tb_kategori WHERE id_kategori=kategori AND status='2' ORDER BY id_sm DESC";
                      $result = mysqli_query($koneksi, $data);
                      while($row = mysqli_fetch_assoc($result)){
                        $idsurat = $row['id_sm'];
                      ?>
                      <tr class="text-center">
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo $row['nomor_agenda']; ?></td>
                        <td><?php echo $row['nomor_sm']; ?></td>
                        <td><?php echo $row['tgl_sm']; ?></td>
                        <td><?php echo $row['nama_kategori_s']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['lampiran']; ?></td>
                        <td>
                          <?php if ($row['status'] == 1) { ?>
                            <span class="badge badge-primary"><i class="fas fa-spinner"></i> Proses</span>
                          <?php }elseif ($row['status'] == 2) { ?>
                            <span class="badge badge-warning"><i class="fas fa-paper-plane"></i> Diajukan</span>
                          <?php }elseif ($row['status'] == 3) { ?>
                            <span class="badge badge-success"><i class="fas fa-check"></i> Selesai</span>
                          <?php } ?>
                        </td>
                        <td>
                          <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#fileModal<?php echo $row['id_sm']; ?>"> Lihat File Pdf</a>
                        </td>
                        <td>
                          <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#detailSuratModal<?php echo $row['id_sm']; ?>"><i class="fas fa-eye"></i></a><br><br>
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
                                      <th>Nomor Agenda</th>
                                      <td><?php echo $rows['nomor_agenda']; ?></td>
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
                                        <?php if ($rows['status'] == 1) { ?>
                                          <span class="badge badge-primary"><i class="fas fa-spinner"></i> Proses</span>
                                        <?php }elseif ($rows['status'] == 2) { ?>
                                          <span class="badge badge-warning"><i class="fas fa-paper-plane"></i> Diajukan</span>
                                        <?php }elseif ($rows['status'] == 3) { ?>
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Selesai</span>
                                        <?php } ?> 
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Diajukan Ke</th>
                                      <td>
                                        <?php 
                                        $data = "SELECT * FROM tb_pengguna WHERE id_pg='$id'";
                                        $result = mysqli_query($koneksi, $data);
                                        $rowp = mysqli_fetch_assoc($result);
                                        ?>
                                        <span><?php echo $rowp['nama_lengkap']; ?></span>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <hr>
                          <form method="POST" action="proses_disposisi.php">
                            <input type="hidden" name="ids" value="<?php echo $rows['id_sm']; ?>">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="">Disposisi</label>
                                <select class="form-control" name="disposisi">
                                  <option selected disabled>Pilih Disposisi</option>
                                  <?php 
                                  $datapg = "SELECT * FROM tb_pengguna WHERE izin_akses IN ('Pimpinan', 'Sekretaris', 'Petugas')";
                                  $result = mysqli_query($koneksi, $datapg);
                                  while ($rowpg = mysqli_fetch_assoc($result)){
                                  ?>
                                  <option value="<?php echo $rowpg['nama_lengkap']; ?>"><?php echo $rowpg['nama_lengkap']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ajukan">Tujuan Disposisi</label>
                                <select class="form-control" name="tujuan">
                                  <option selected disabled>Pilih Tujuan Disposisi</option>
                                  <?php 
                                  $datapg = "SELECT * FROM tb_pengguna WHERE izin_akses IN ('Pimpinan', 'Sekretaris', 'Petugas')";
                                  $result = mysqli_query($koneksi, $datapg);
                                  while ($rowpg = mysqli_fetch_assoc($result)){
                                  ?>
                                  <option value="<?php echo $rowpg['jabatan']; ?>"><?php echo $rowpg['jabatan']; ?> ( <?php echo $rowpg['nama_lengkap']; ?> )</option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="pilihan">Catatan:</label><br>
                              <select class="form-control select2" name="catatan[]" multiple="multiple">
                                  <option value="Dipahami">Dipahami</option>
                                  <option value="Arsip">Arsip</option>
                                  <option value="Segera">Segera</option>
                              </select>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Disposisi</button>
                          </div>
                          </form>
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
  <!-- Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>

</body>

</html>