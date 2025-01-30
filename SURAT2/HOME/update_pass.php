<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['idpg'];
    $password = $_POST['password'];

    // Periksa apakah password diisi dan memiliki panjang lebih dari 6 karakter
    if(empty($password) || strlen($password) < 6) {
        echo '<script language="javascript" type="text/javascript">
              alert("Password harus diisi dan memiliki panjang minimal 6 karakter.");</script>';
        exit; // Stop eksekusi jika password tidak memenuhi syarat
    }

    // Menggunakan md5 untuk hash password
    $password = md5($password);

    //koneksi
    include 'koneksi.php';    

    // Masukkan data ke dalam database
    $query = "UPDATE tb_pengguna SET password='$password' WHERE id_pg=$id";

    if (mysqli_query($koneksi, $query)) {
        echo '<script language="javascript" type="text/javascript">
              alert("Data berhasil diupdate.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pengguna.php'>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}

?>