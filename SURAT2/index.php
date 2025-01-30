<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="HOME/img/logo/logo.png" rel="icon">
  <title>Surat - Login</title>
  <link href="HOME/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="HOME/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="HOME/css/ruang-admin.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('bg1.jpeg'); /* Ganti 'path/to/your/image.jpg' dengan path gambar Anda */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      height: 90vh;
      margin: 0;
      padding: 0;
    }
    .card {
      background: rgba(255, 255, 255, 0.3); /* Set the background to transparent */
      border: none; /* Remove the border if needed */
      
    }
    .password-toggle {
      cursor: pointer;
    }
    .btn-primary {
    background-color: #3F51B5; /* Warna latar belakang tombol */
    border-color: #3F51B5; /* Warna border tombol */
    color: white; /* Warna teks tombol */
    transition: background-color 0.3s ease;
  }
  .btn-primary:hover {
    background-color: #0056b3; /* Warna saat tombol di-hover */
    border-color: #0056b3; /* Warna border saat tombol di-hover */
  }
  .btn-primary:active {
    background-color: #0056b3; /* Warna saat tombol ditekan */
    border-color: #0056b3; /* Warna border saat tombol ditekan */
  }
  .h1-capitalized {
      text-transform: uppercase; /* Mengubah teks menjadi kapital */
      font-weight: 600; /* Mengatur tebal teks menjadi semi bold */
      color: #212121; /* Warna teks */
      font-family: 'Touch Me Sans Petite Semi Bold', sans-serif; 
  } 
  .rosi{
    color: #3F51B5;
  }     
  </style>
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login mt-5">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-12 col-md-9">
        <div class="card shadow-sm my-1">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <div class="text-center">
                  <img src="HOME/img/logo/logo.png" alt="Logo" style="width: 100px; height: 100px;">
                  <h1 class="h5 text-gray-900 mb-4 h1-capitalized" style="margin-top: 20px;"><marquee>Sistem Manajemen Surat Dinas Perikanan Kabupaten Pamekasan</marquee></h1>
                </div>
                  <form class="user" method="POST" action="proses_login.php">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="exampleInputuser" name="username" aria-describedby="userHelp"
                          placeholder="Masukan Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password">
                        <div class="input-group-append">
                          <span class="input-group-text password-toggle"><i class="fas fa-eye"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingat saya</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                      <div style="margin-top: 5px; text-align: center;">
                        <img src="uas.png" alt="Logo" style="width: 30px; height: 30px;">
                          <a href="https://www.istannuqayah.ac.id/sejarah-ist-annuqayah/" style="color: #0056b3; margin-left: 5px; vertical-align: middle; margin-top: 20px;">Universitas Annuqayah</a>
                       </div>
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
  <!-- Login Content -->
  <script src="HOME/vendor/jquery/jquery.min.js"></script>
  <script src="HOME/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="HOME/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="HOME/js/ruang-admin.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".password-toggle").click(function() {
        var passwordField = $("#exampleInputPassword");
        var passwordFieldType = passwordField.attr('type');
        if (passwordFieldType === 'password') {
          passwordField.attr('type', 'text');
        } else {
          passwordField.attr('type', 'password');
        }
      });
    });
  </script>
</body>

</html>
