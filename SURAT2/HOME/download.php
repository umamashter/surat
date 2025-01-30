<?php
// Include file konfigurasi database Anda
include('koneksi.php');

// Ambil parameter id_sk dari URL
$id_sk = $_GET['id_sk'];

// Query database untuk mendapatkan informasi berkas
$query = "SELECT berkas_kesalahan FROM tb_sk WHERE id_sk = $id_sk";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Ambil nama berkas dan jalur file
    $berkas_kesalahan = $row['berkas_kesalahan'];
    $file_path = 'berkaskesalahan/' . $berkas_kesalahan;

    // Tentukan tipe konten dan header untuk memulai unduhan
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $berkas_kesalahan . '"');
    
    // Baca dan kirimkan berkas sebagai respons
    readfile($file_path);

    // Tutup koneksi database
    mysqli_close($koneksi);
} else {
    // Tampilkan pesan kesalahan jika query gagal
    echo "Query gagal: " . mysqli_error($koneksi);
}
?>