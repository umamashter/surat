<?php
session_start();

// Connect to the database
include 'HOME/koneksi.php';

// Get user input from the registration form
$username = $_POST['username'];
$password = md5($_POST['password']); // Hash the password using MD5 (not recommended for production)
$full_name = $_POST['full_name'];
$position = $_POST['position'];
$access = $_POST['access'];

// Insert user data into the database
$query = "INSERT INTO tb_pengguna (username, password, nama_lengkap, jabatan, izin_akses) 
          VALUES ('$username', '$password', '$full_name', '$position', '$access')";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Registration successful
    echo '<script language="javascript" type="text/javascript">
        alert("Registrasi berhasil! Silakan login.");</script>';
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    exit();
} else {
    // Registration failed
    echo '<script language="javascript" type="text/javascript">
        alert("Registrasi gagal. Silakan coba lagi.");</script>';
    echo "<meta http-equiv='refresh' content='0; url=register.php'>";
    exit();
}
?>
