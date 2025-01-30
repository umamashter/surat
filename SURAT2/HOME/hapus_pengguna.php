<?php
// Sambungkan ke database Anda
include 'koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_pengguna WHERE id_pg = $id";

    if ($koneksi->query($sql) === TRUE) {
        echo "Surat telah dihapus.";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

$koneksi->close();
?>