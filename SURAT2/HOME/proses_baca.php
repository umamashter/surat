<?php
// Assuming you have a database connection
include 'koneksi.php';

$idsk = $_POST['idsk'];
// SQL query to update the status column to 2 in the tb_sk table
$sql = "UPDATE tb_sk SET status = 2 WHERE id_sk = $idsk";

// Execute the query
if ($koneksi->query($sql) === TRUE) {
    echo '<script language="javascript" type="text/javascript">
        alert("Updated successfully");</script>';
    echo "<meta http-equiv='refresh' content='0; url=umum_keluar.php'>";
} else {
    echo "Error updating record: " . $koneksi->error;
}

// Close the koneksiection
$koneksi->close();
?>