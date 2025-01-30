<?php
// Koneksi ke database (ganti sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Ambil data dari form
$idp = $_POST['idp'];
$tanggalKeluar = $_POST['tanggalKeluar'];
$nomorAgenda = $_POST['nomorAgenda'];
$kode = $_POST['kode'];
$nomorSuratKeluar = $_POST['nomorSuratKeluar'];
$tanggalSuratKeluar = $_POST['tanggalSuratKeluar'];
$penerima = $_POST['penerima'];
$perihal = $_POST['perihal'];
$lampiran = $_POST['lampiran'];
$tindakan = $_POST['tindakan'];

// Simpan data surat masuk ke database
$query = "INSERT INTO tb_sk (nomor_agenda, kode, nomor_sk, tgl_keluar, tgl_sk, penerima_sk, perihal_sk, lampiran_sk, status, tindakan, dari_disposisi) 
              VALUES ('$nomorAgenda', '$kode', '$nomorSuratKeluar', '$tanggalKeluar', '$tanggalSuratKeluar', '$penerima', '$perihal', '$lampiran', '1', '$tindakan', '$idp')";
if ($koneksi->query($query) === TRUE) {
    // Ambil ID surat yang baru saja disimpan
    $surat_id = $koneksi->insert_id;

    // Proses upload file PDF
    $file_surat = $_FILES['file_pdf']['name'];
    $file_surat_tmp = $_FILES['file_pdf']['tmp_name'];

    foreach ($file_surat as $index => $nama_file) {
        $ukuran_file = $_FILES['file_pdf']['size'][$index];

        // Batasi ukuran file maksimal (50 MB)
        if ($ukuran_file <= 50000000) {
            $target_dir = "suratkeluar/";
            $target_file = $target_dir . basename($nama_file);

            if (move_uploaded_file($file_surat_tmp[$index], $target_file)) {
                // Simpan informasi file ke database
                $query = "INSERT INTO file_surat_k (sk_id, nama_file) VALUES ('$surat_id', '$nama_file')";
                $koneksi->query($query);
            } else {
                echo '<script language="javascript" type="text/javascript">
                  alert("Gagal mengupload file.!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=surat_keluar_p.php'>";
            }
        } else {
            echo '<script language="javascript" type="text/javascript">
              alert("Ukuran file terlalu besar.!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=surat_keluar_p.php'>";
        }
    }

    echo '<script language="javascript" type="text/javascript">
        alert("Data Berhasil Masuk!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=surat_keluar_p.php'>";
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>