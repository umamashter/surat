<?php
session_start();

// Periksa apakah pengguna sudah login
if(isset($_SESSION['username'])) {
    // Lakukan koneksi ke database (Anda mungkin sudah memiliki koneksi ini sebelumnya)
    include 'koneksi.php';

    // Periksa apakah file gambar dipilih
    if(isset($_FILES['foto'])) {
        $foto = $_FILES['foto'];

        // Periksa apakah tidak ada error pada file yang diupload
        if($foto['error'] === 0) {
            // Pindahkan file gambar ke direktori yang diinginkan
            $nama_file_baru = $_SESSION['username'] . '_' . $foto['name'];
            $tujuan = 'pengguna/' . $nama_file_baru;
            move_uploaded_file($foto['tmp_name'], $tujuan);

            // Update kolom foto pada tabel pengguna
            $username = $_SESSION['username'];
            $query = "UPDATE tb_pengguna SET foto='$nama_file_baru' WHERE username='$username'";
            mysqli_query($koneksi, $query);

            // Set session variable indicating successful photo update
            $_SESSION['photo_updated'] = true;

            // Redirect back to identitas.php
            header("Location: identitas.php");
            exit(); // Make sure no code is executed after redirection
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        echo "Tidak ada file yang dipilih.";
    }
} else {
    echo "Silakan login terlebih dahulu.";
}
?>
