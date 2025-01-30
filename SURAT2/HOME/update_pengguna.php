<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pg_id = $_POST["id"];
    $username = $_POST['username'];
    $nama = $_POST["nama"];
    $jabatan = $_POST['jabatan'];
    $akses = $_POST['akses'];

    //koneksi
    include 'koneksi.php';

    // Upload gambar jika ada perubahan gambar
    if ($_FILES["foto"]["name"]) {
        $gambar = $_FILES["foto"]["name"];
        $gambar_tmp = $_FILES["foto"]["tmp_name"];
        $upload_folder = "pengguna/"; // Direktori penyimpanan gambar
        move_uploaded_file($gambar_tmp, $upload_folder . $gambar);
        
        // Update data pengguna dengan gambar
        $query = "UPDATE tb_pengguna SET username='$username', nama_lengkap='$nama', jabatan='$jabatan', izin_akses='$akses', foto='$gambar' WHERE id_pg=$pg_id";
    } else {
        // Update data pengguna tanpa perubahan gambar
        $query = "UPDATE tb_pengguna SET username='$username', nama_lengkap='$nama', jabatan='$jabatan', izin_akses='$akses' WHERE id_pg=$pg_id";
    }

    if (mysqli_query($koneksi, $query)) {
        echo '<script language="javascript" type="text/javascript">
          alert("Data pengguna berhasil diperbaharui.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pengguna.php'>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>