<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan id_sk dari parameter atau formulir
$id_sk = $_GET['id']; // Sesuaikan ini dengan cara Anda mendapatkan id_kategori

// Membuat pernyataan SQL DELETE
$sql = "DELETE FROM tb_sk WHERE id_sk = $id_sk";

// Menjalankan pernyataan DELETE
if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
        alert("Data surat keluar berhasil dihapus");</script>';
    echo "<meta http-equiv='refresh' content='0; url=surat_keluar.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Menutup koneksi
$koneksi->close();
?>