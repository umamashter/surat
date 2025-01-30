<?php
// Database connection details
include 'koneksi.php';

// Process update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Assuming you have a form field named 'nama_kategori' and 'kategori_id'
    $nama_kategori = $_POST['kategori'];
    $kategori_id = $_POST['kategori_id'];

    // SQL query to update data
    $sql = "UPDATE tb_kategori SET nama_kategori_s='$nama_kategori' WHERE id_kategori='$kategori_id'";

    if ($koneksi->query($sql) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
        alert("Record updated successfully");</script>';
        echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Close the database connection
$koneksi->close();
?>