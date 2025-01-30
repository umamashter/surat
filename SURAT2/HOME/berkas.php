<?php
// Konfigurasi database
include 'koneksi.php';

// ID SM yang akan diupdate
$id_sm = $_GET['id']; // Ganti dengan ID_SM yang sesuai

// SQL untuk melakukan update
$sql = "UPDATE tb_sm SET status_baca = 1 WHERE id_sm = $id_sm";

// Menjalankan perintah SQL
if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
        alert("Berkas Berhasil Diterima.");</script>';
    echo "<meta http-equiv='refresh' content='0; url=surat_masuk_p.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Menutup koneksi
$koneksi->close();
?>