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
  <title>Surat - Data Laporan Surat Masuk</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
        /* Menetapkan lebar form agar sesuai dengan kebutuhan */
        .custom-form {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Mengatur jarak antara input tanggal dan select status */
        .form-group {
            margin-bottom: 15px;
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
            <h1 class="h3 mb-0 text-gray-800">Data Laporan</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item">Laporan Surat Masuk</li>
              <li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Laporan Surat Masuk</h6>
                </div>
                <div class="container">
                  <form method="POST">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="custom-form">
                              <div class="form-group">
                                  <label for="tanggal">Tanggal:</label>
                                  <input type="date" class="form-control" id="tanggal" name="tanggal">
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="custom-form">
                              <div class="form-group">
                                  <label for="status">Status:</label>
                                  <select class="form-control" id="status" name="status">
                                    <option selected disabled>Pilih Status Surat</option>
                                    <option value="1">Proses</option>
                                    <option value="2">Diajukan</option>
                                    <option value="3">Disposisi</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Filter</button>
                  </form>
                </div>
                <br>
                <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $tanggal = $_POST['tanggal'];
                  $status = $_POST['status'];
                ?>
                <hr>
                <div class="table-responsive p-3">
                  <a class="btn btn-sm btn-success" href="cetak_semua.php?tanggal=<?php echo $tanggal; ?>&status=<?php echo $status; ?>" target="_blank">Cetak Semua</a><br><br>
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No. Agenda</th>
                        <th>No. Surat Masuk</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;

                      $sql = "SELECT * FROM tb_sm WHERE tgl_sm = '$tanggal' AND status = '$status'";
                      $result = $koneksi->query($sql);
                      while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo $row['tgl_sm']; ?></td>
                        <td><?php echo $row['nomor_agenda']; ?></td>
                        <td><?php echo $row['nomor_sm']; ?></td>
                        <td><?php echo $row['perihal_surat']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td>
                          <a class="btn btn-sm btn-success" href="cetak.php?id=<?php echo $row['id_sm']; ?>&tanggal=<?php echo $tanggal; ?>&status=<?php echo $status; ?>" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php }else{ ?>
                  <div class="alert alert-sm alert-primary">
                    <center>
                      <strong>Perhatian!</strong> Silakan Filter Laporan
                    </center>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!--Row-->

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