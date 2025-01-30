<?php
// Sambungkan ke database Anda
include 'koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_sm WHERE id_sm = $id";

    if ($koneksi->query($sql) === TRUE) {
        echo "Surat telah dihapus.";
    } else {
        echo "Error: " . $koneksi->error;
    }

    $query = "DELETE FROM file_surat WHERE surat_id = $id";

    if ($koneksi->query($query) === TRUE) {
        echo "Surat telah dihapus.";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

$koneksi->close();
?>