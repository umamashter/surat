<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="HOME/img/logo/logo.png" rel="icon">
  <title>Surat - Registrasi Pengguna</title>
  <link href="HOME/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="HOME/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="HOME/css/ruang-admin.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('bg1.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      height: 90vh;
      margin: 0;
      padding: 0;
    }
    .card {
      background: rgba(255, 255, 255, 0.7); /* Set the background to transparent */
      border: none; /* Remove the border if needed */
    }
    .btn-primary {
      transition: background-color 0.3s ease;
      background-color: #007bff; /* Warna latar belakang tombol */
      border-color: #007bff; /* Warna border tombol */
      color: white; /* Warna teks tombol */
    }
    .btn-primary:hover {
      background-color: #0056b3; /* Warna saat tombol di-hover */
      border-color: #0056b3; /* Warna border saat tombol di-hover */
    }
    .btn-primary:active {
      background-color: #0056b3; /* Warna saat tombol ditekan */
      border-color: #0056b3; /* Warna border saat tombol ditekan */
    }
    .password-toggle {
      color: #6f42c1; /* Warna ikon mata */
    }
  </style>
</head>

<body class="bg-gradient-login">
  <!-- Registration Form -->
  <div class="container-register mt-1">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-12 col-md-9">
        <div class="card shadow-sm my-4">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="register-form">
                    <div class="text-center">
                      <h1 class="h5 text-gray-900 mb-4">Registrasi Pengguna</h1>
                    </div>
                    <form class="user" method="POST" action="proses_register.php">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputUsername" name="username" aria-describedby="usernameHelp" placeholder="Masukkan Username" required>
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputFullName" name="full_name" placeholder="Nama Lengkap" required>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputPosition" name="position" placeholder="Jabatan" required>
                      </div>
                      <div class="form-group">
                        <select class="form-control" id="exampleAccess" name="access" required>
                          <option value="Admin">Admin</option>
                          <option value="Pimpinan">Pimpinan</option>
                          <option value="Sekretaris">Sekretaris</option>
                          <option value="Petugas">Petugas</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        <a href="index.php" class="btn btn-primary btn-block">Login</a>
                      </div>                                    
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Registration Form -->
  <script src="HOME/vendor/jquery/jquery.min.js"></script>
  <script src="HOME/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="HOME/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="HOME/js/ruang-admin.min.js"></script>
</body>

</html>
