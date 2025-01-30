<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST["nama"];
    $jabatan = $_POST['jabatan'];
    $akses = $_POST['akses'];

    //koneksi
    include 'koneksi.php';    
    // Upload gambar
    $gambar = $_FILES["foto"]["name"];
    $gambar_tmp = $_FILES["foto"]["tmp_name"];
    $upload_folder = "pengguna/"; // Direktori penyimpanan gambar
    move_uploaded_file($gambar_tmp, $upload_folder . $gambar);

    // Masukkan data ke dalam database
    $query = "INSERT INTO tb_pengguna (username, password, nama_lengkap, jabatan, izin_akses, foto) VALUES ('$username', '$password', '$nama', '$jabatan', '$akses', '$gambar')";
    if (mysqli_query($koneksi, $query)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data pengguna berhasil disimpan.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pengguna.php'>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>