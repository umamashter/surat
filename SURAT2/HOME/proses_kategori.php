<?php
// Database connection details
include 'koneksi.php';

// Process simpan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    // Assuming you have a form field named 'nama_kategori'
    $nama_kategori = $_POST['kategori'];

    // SQL query to insert data
    $sql = "INSERT INTO tb_kategori (nama_kategori_s) VALUES ('$nama_kategori')";

    if ($koneksi->query($sql) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
        alert("Record inserted successfully");</script>';
        echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Close the database connection
$koneksi->close();
?>