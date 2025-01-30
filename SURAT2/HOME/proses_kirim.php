<?php
// Pastikan metode yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sambungkan ke database (gantilah dengan koneksi yang sesuai)
    include 'koneksi.php';

    // Ambil data dari formulir
    $id_sk = $_POST['idsk'];
    $proses_kirim = $_POST['kirim_berkas'];
    $tindakan = $_POST['tindakan'];

    // Update status berdasarkan pilihan
    if ($proses_kirim == "Cek Kembali") {
        $status = 0;

        // Ambil nama file PDF
        $pdf_name = $_FILES['fileUpload']['name'];

        // Ambil ukuran file PDF
        $pdf_size = $_FILES['fileUpload']['size'];

        // Mendapatkan tipe file
        $file_type = $_FILES['fileUpload']['type'];

        // Mendapatkan ekstensi file
        $file_extension = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);

        // Menentukan tipe file yang diizinkan (PDF dan Word)
        $allowed_types = array("application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");

        // Memeriksa apakah tipe file dan ekstensi file diizinkan
        if (!in_array($file_type, $allowed_types) || !in_array($file_extension, array("pdf", "doc", "docx"))) {
            echo "Hanya file PDF dan Word yang diizinkan.";
            exit();
        }

        // Cek ukuran file PDF (maksimum 50MB)
        if ($pdf_size > 50 * 1024 * 1024) {
            echo "Ukuran file PDF melebihi batas maksimum (50MB).";
            exit();
        }

        // Pindahkan file PDF ke direktori yang diinginkan
        $target_directory = "berkaskesalahan/"; // Ganti dengan direktori yang sesuai
        $target_file = $target_directory . basename($pdf_name);

        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file)) {
        } else {
            echo "Gagal mengupload file PDF.";
            exit();
        }

    } elseif ($proses_kirim == "Kirim") {
        $status = 3;
        $pdf_name = ""; // Jika tidak ada file yang diupload
    }

    // Update data di tabel tb_sk
    $query = "UPDATE tb_sk SET status = '$status', tindakan = '$tindakan', berkas_kesalahan = '$pdf_name' WHERE id_sk = '$id_sk'";

    if (mysqli_query($koneksi, $query)) {
        // Redirect atau lakukan tindakan lain setelah berhasil memperbarui data
        echo '<script language="javascript" type="text/javascript">
          alert("Data terkirim.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=pimpinan_keluar.php'>";
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
} else {
    // Tindakan jika metode bukan POST
    echo "Metode yang digunakan bukan POST";
}
?>