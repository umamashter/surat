<?php
include 'koneksi.php';

// Replace 'your_table_name' with the actual name of your table
$idSk = $_POST['idk']; // Replace 123 with the actual ID you want to update
$tindakan = $_POST['keteranganPerbaiki'];

// SQL query to update the table
$sql = "UPDATE tb_sk SET tindakan = '$tindakan', status = '4' WHERE id_sk = '$idSk'";

if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
          alert("Surat keluar diperbaiki.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=umum_keluar.php'>";
} else {
    echo "Error updating record: " . $koneksi->error;
}

// Close koneksiection
$koneksi->close();

?>