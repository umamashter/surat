<?php
// Koneksi ke database
include 'koneksi.php';

// Mendapatkan id_kategori dari parameter atau formulir
$id_kategori = $_GET['id']; // Sesuaikan ini dengan cara Anda mendapatkan id_kategori

// Membuat pernyataan SQL DELETE
$sql = "DELETE FROM tb_kategori WHERE id_kategori = $id_kategori";

// Menjalankan pernyataan DELETE
if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
        alert("Data kategori berhasil dihapus");</script>';
    echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Menutup koneksi
$koneksi->close();
?>