<?php
session_start();

// Connect to the database
include 'HOME/koneksi.php';

// Get the submitted username and password
$username = $_POST['username'];
$password = md5($_POST['password']); // Hash the password using MD5 (not recommended for production)

// Check if the Pengguna
$query = "SELECT * FROM tb_pengguna WHERE username='$username' AND password='$password' LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    // Regular user login successful
    $data = mysqli_fetch_assoc($result);

    $_SESSION['pengguna_type'] = 'pengguna';
    $_SESSION['pengguna'] = $data['id_pg'];
    $_SESSION['nama'] = $data['nama_lengkap'];
    $_SESSION['jabatan'] = $data['jabatan'];
    $_SESSION['akses'] = $data['izin_akses'];

    // Set username in session
    $_SESSION['username'] = $username;
    
    // Menyimpan URL foto profil pengguna ke dalam sesi
    $_SESSION['foto'] = $data['foto']; // Ganti 'foto' dengan nama kolom yang sesuai dalam tabel tb_pengguna

    // Setelah berhasil login
    
    if ($_SESSION['akses'] == 'Admin') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=HOME/index.php'>";
        exit();
    }elseif ($_SESSION['akses'] == 'Pimpinan') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=HOME/index.php'>";
        exit();
    }elseif ($_SESSION['akses'] == 'Sekretaris') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=HOME/index.php'>";
        exit();
    }elseif ($_SESSION['akses'] == 'Petugas') {
        echo '<script language="javascript" type="text/javascript">
        alert("Anda Berhasil Masuk, Selamat Datang '.$_SESSION['nama'].'!");</script>';
        echo "<meta http-equiv='refresh' content='0; url=HOME/index.php'>";
        exit();
    }
}

// If login failed, redirect back to the login page with an error message
header("Location: index.php?error=1");
exit();
?>