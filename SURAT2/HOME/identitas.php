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
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .profil {
        font-size: 30px; /* Atur ukuran font kecil */
        font-weight: bold;
    }
    .sandi {
        font-size: 18px; /* Atur ukuran font kecil */
        font-weight: bold;
    }
    .password-change {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
   }
   .password-change.active {
    opacity: 1;
   }
   .profil-change {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
   }
   .profil-change.active {
    opacity: 1;
   }

</style>

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
            <h1 class="h6 mb-0 text-gray-800">Profi Pengguna</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Profil Penguna</li>
            </ol>
          </div>       
          
          <!-- Datatables -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Profi Pengguna</h6>                  
                </div>
                <div class="table-responsive p-3"> 
                                          
                <?php                       
                  // Ambil data pengguna dari sesi
                  $username = $_SESSION['username'];
                  $nama_lengkap = $_SESSION['nama'];
                  $jabatan = $_SESSION['jabatan'];
                  $foto = $_SESSION['foto']; // asumsikan Anda sudah menyimpan URL foto profil di sesi
                  ?> 
                  
                  <div class="col-md-4 mb-4">
                       <img src="pengguna/<?php echo $foto; ?>" class="card-img-top rounded-circle" alt="Foto Profil" style="width: 100px; height: 100px;">                            
                    </div> 

                  <?php
                    // Tampilkan informasi profil pengguna
                    echo "<p>Username: $username</p>";
                    echo "<p>Nama Lengkap: $nama_lengkap</p>";
                    echo "<p>Jabatan: $jabatan</p>";
                    ?>
                                                           
                    <!-- Form untuk mengubah kata sandi -->
                    <i id="passwordIcon" class="bi bi-key-fill" style="font-size: 20px; background-color: #6777EF; color: white; padding: 2px 15px; border-radius: 5px; cursor: pointer; margin-bottom: 10px; font-style: normal;"> <span style="font-size: 14px;">Password</span></i>
                      <div id="passwordChange" class="password-change" style="display: none;">
                         <h5>ubah sandi</h5>
                      <label>Username: <?php echo $_SESSION['username']; ?></label>
                        <form action='update_pass.php' method='POST'>
                           <input type='hidden' name='idpg' value='<?php echo $_SESSION["pengguna"]; ?>'> <!-- ID pengguna -->
                                <div class="form-group">
                                    <label for='password'>sandi baru:</label>
                                    <input type='password' class="form-control" name='password' id='password'>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button id="cancelButton" type="button" class="btn btn-secondary">Batal</button>
                        </form>
                      </div> 
                        <!-- Bagian HTML -->
                                  
                      <i id="profilIcon" class="bi bi-person-circle" style="font-size: 20px; background-color: #6777EF; color: white; padding: 2px 15px; border-radius: 5px; cursor: pointer; margin-bottom: 10px; font-style: normal;"> <span style="font-size: 14px;">Profile</span></i>
                      <div id="profilChange" class="profil-change" style="display: none;">
                         <h5>ubah foto</h5>
                      <label>Username: <?php echo $_SESSION['username']; ?></label>
                      <form action="update_foto.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="foto">Pilih Foto Profil Baru:</label>
                                  <input type="file" class="form-control-file" id="foto" name="foto">
                              </div>
                              <button type="submit" class="btn btn-primary" onclick="redirectToPreviousPage()">Simpan</button>
                              <button id="batal" type="button" class="btn btn-secondary">Batal</button>
                        </form> 
                      </div>                 
                </div>
              </div>
            </div>
          </div>

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

  <!-- Page level custom scripts -->
  <script>
    document.getElementById("passwordIcon").addEventListener("click", function() {
    var passwordChange = document.getElementById("passwordChange");
    if (passwordChange.style.display === "none") {
        passwordChange.style.display = "block";
    } else {
        passwordChange.style.display = "none";
    }
});
document.getElementById('passwordIcon').addEventListener('click', function() {
    setTimeout(function() {
        document.getElementById('passwordChange').style.display = 'block';
    }, 500); // Ubah angka 200 menjadi jumlah milidetik penundaan yang diinginkan
});
</script>
<script>
    // Fungsi untuk menyembunyikan formulir perubahan sandi
    function cancel() {
        document.getElementById('passwordChange').style.display = 'none';
    }

    // Menambahkan event listener untuk tombol "Batal"
    document.getElementById('cancelButton').addEventListener('click', cancel);
    // Menampilkan nama pengguna di elemen span
    document.getElementById('usernameSpan').textContent = username;
</script>
<script>
    var username = "<?php echo $_SESSION['username']; ?>";
</script>
<!-- Di bagian head atau sebelum penutup tag </body> -->
<script>
    // Function untuk menampilkan alert jika foto berhasil diupdate
    function displayAlert() {
        if(<?php echo isset($_SESSION['photo_updated']) && $_SESSION['photo_updated'] ? 'true' : 'false'; ?>) {
            alert("Foto profil berhasil diperbarui.");
            <?php unset($_SESSION['photo_updated']); ?> // Hapus session setelah alert ditampilkan
        }
    }
    
    // Panggil function displayAlert saat halaman dimuat
    window.onload = displayAlert;
</script>
<script>
    document.getElementById("profilIcon").addEventListener("click", function() {
    var profilChange = document.getElementById("profilChange");
    if (profilChange.style.display === "none") {
        profilChange.style.display = "block";
    } else {
        profilChange.style.display = "none";
    }
});
document.getElementById('profilIcon').addEventListener('click', function() {
    setTimeout(function() {
        document.getElementById('profilChange').style.display = 'block';
    }, 500); // Ubah angka 200 menjadi jumlah milidetik penundaan yang diinginkan
});
</script>
<script>
    // Fungsi untuk menyembunyikan formulir perubahan sandi
    function cancel() {
        document.getElementById('profilChange').style.display = 'none';
    }

    // Menambahkan event listener untuk tombol "Batal"
    document.getElementById('batal').addEventListener('click', cancel);
    // Menampilkan nama pengguna di elemen span
    document.getElementById('usernameSpan').textContent = username;
</script>

</body>

</html>