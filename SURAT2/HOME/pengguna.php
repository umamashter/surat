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
  <title>Surat - Data Pengguna</title>
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
            <h1 class="h6 mb-0 text-gray-800">Data Pengguna</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Data Penguna</li>
            </ol>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
                  <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#myModal"><i class="fas fa fa-plus"></i> Tambah Data</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Hak Akses</th>
                        <th>Foto</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1; 
                      $data = "SELECT * FROM tb_pengguna";
                      $result = mysqli_query($koneksi,$data);
                      while ($row = mysqli_fetch_assoc($result)){
                      ?>
                      <tr class="text-center">
                        <td><?php echo $no++; ?>.</td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['nama_lengkap']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><?php echo $row['izin_akses']; ?></td>
                        <td>
                          <img src="pengguna/<?php echo $row['foto']; ?>" alt="Foto Pengguna" title="<?php echo $row['nama_lengkap']; ?>" width="60px" height="60px">
                        </td>
                        <td>
                          <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#myModaledit<?php echo $row['id_pg']; ?>"><i class="fas fa fa-edit"></i></a><br><br>
                          <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#myModalpass<?php echo $row['id_pg']; ?>"><i class="fas fa fa-lock"></i></a><br><br>
                          <button class="btn btn-sm btn-danger deleteBtn" data-id="<?php echo $row['id_pg']; ?>"><i class="fas fa fa-trash"></i></button>
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

          <!-- Modal Tambah-->
          <div class="modal fade" id="myModal">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <!-- Header Modal -->
                      <div class="modal-header">
                          <h4 class="modal-title">Tambah Pengguna</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Isi Modal -->
                      <div class="modal-body">
                        <form method="POST" action="proses_pengguna.php" enctype="multipart/form-data">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username">
                              </div>
                              <div class="form-group">
                                <label for="namaLengkap">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="namaLengkap" name="nama">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="jabatan">Jabatan:</label>
                                  <input type="text" class="form-control" id="jabatan" name="jabatan">
                                </div>
                                <div class="form-group">
                                  <label for="hakAkses">Hak Akses:</label>
                                  <select class="form-control" name="akses">
                                    <option selected disabled>Pilih Hak Akses</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Petugas">Petugas</option>
                                    <option value="Pimpinan">Pimpinan</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="foto">Password:</label>
                                  <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group">
                                  <label for="foto">Upload Foto:</label>
                                  <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Footer Modal -->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Modal Edit-->
          <?php
          $datap = "SELECT * FROM tb_pengguna";
          $result = mysqli_query($koneksi, $datap);
          while ($rowp = mysqli_fetch_assoc($result)){
          ?>
          <div class="modal fade" id="myModaledit<?php echo $rowp['id_pg']; ?>">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <!-- Header Modal -->
                      <div class="modal-header">
                          <h4 class="modal-title">Edit Pengguna</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Isi Modal -->
                      <div class="modal-body">
                        <form method="POST" action="update_pengguna.php" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $rowp['id_pg']; ?>">
                        <div class="container">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $rowp['username']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="namaLengkap">Nama Lengkap:</label>
                                <input type="text" class="form-control" id="namaLengkap" name="nama" value="<?php echo $rowp['nama_lengkap']; ?>">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="jabatan">Jabatan:</label>
                                  <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $rowp['jabatan']; ?>">
                                </div>
                                <div class="form-group">
                                  <label for="hakAkses">Hak Akses:</label>
                                  <select class="form-control" name="akses">
                                    <option selected disabled>Pilih Hak Akses</option>
                                    <option <?php if($rowp['izin_akses'] == "Admin"){echo "selected='selected'";} ?> value="Admin">Admin</option>
                                    <option <?php if($rowp['izin_akses'] == "Petugas"){echo "selected='selected'";} ?> value="Petugas">Petugas</option>
                                    <option <?php if($rowp['izin_akses'] == "Pimpinan"){echo "selected='selected'";} ?> value="Pimpinan">Pimpinan</option>
                                    <option <?php if($rowp['izin_akses'] == "Sekretaris"){echo "selected='selected'";} ?> value="Sekretaris">Sekretaris</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="foto">Upload Foto:</label>
                                  <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Footer Modal -->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
          <?php } ?>

          <!-- Modal pass-->
          <?php
          $datap = "SELECT * FROM tb_pengguna";
          $result = mysqli_query($koneksi, $datap);
          while ($rowp = mysqli_fetch_assoc($result)){
          ?>
          <div class="modal fade" id="myModalpass<?php echo $rowp['id_pg']; ?>">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <!-- Header Modal -->
                      <div class="modal-header">
                          <h4 class="modal-title">Edit Password</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Isi Modal -->
                      <div class="modal-body">
                        <form method="POST" action="update_pass.php" enctype="multipart/form-data">
                          <input type="hidden" name="idpg" value="<?php echo $rowp['id_pg']; ?>">
                        <div class="container">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Nama Lengkap:</label>
                                  <input style="text-align: center;" type="text" class="form-control" id="nama" value="<?php echo $rowp['nama_lengkap']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="">Ubah Password:</label>
                                  <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Footer Modal -->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
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

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

  <script>
    $(document).ready(function () {
        $(".deleteBtn").click(function () {
            var id = $(this).data("id");
            var confirmDelete = confirm("Yakin ingin menghapus pengguna ini?");

            if (confirmDelete) {
                // Lakukan permintaan AJAX ke script PHP penghapusan
                $.ajax({
                    url: "hapus_pengguna.php",
                    type: "POST",
                    data: { id: id },
                    success: function (response) {
                        // Handle hasil penghapusan jika diperlukan
                        location.reload(); // Refresh halaman setelah penghapusan
                    }
                });
            }
        });
    });
  </script>

</body>

</html>