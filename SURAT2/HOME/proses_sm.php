<?php
// Koneksi ke database (ganti sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Ambil data dari form
$tanggal_masuk = $_POST['tanggal_masuk_surat'];
$nomor_agenda = $_POST['nomor_agenda'];
$kode_surat = $_POST['kode_surat'];
$nomor_surat = $_POST['nomor_surat'];
$tanggal_surat = $_POST['tanggal_surat'];
$kategori = $_POST['kategori'];
$pengirim_surat = $_POST['pengirim_surat'];
$perihal_surat = $_POST['perihal_surat'];
$lampiran_surat = $_POST['lampiran_surat'];
$tindakan = $_POST['tindakan'];

// Simpan data surat masuk ke database
$query = "INSERT INTO tb_sm (nomor_agenda, kode_sm, nomor_sm, tgl_surat, tgl_sm, kategori, pengirim, perihal_surat, lampiran, disposisi, status, tindakan) 
              VALUES ('$nomor_agenda', '$kode_surat', '$nomor_surat', '$tanggal_masuk', '$tanggal_surat', '$kategori', '$pengirim_surat', '$perihal_surat', '$lampiran_surat', '', '1', '$tindakan')";
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
            $target_dir = "suratmasuk/";
            $target_file = $target_dir . basename($nama_file);

            if (move_uploaded_file($file_surat_tmp[$index], $target_file)) {
                // Simpan informasi file ke database
                $query = "INSERT INTO file_surat (surat_id, nama_file) VALUES ('$surat_id', '$nama_file')";
                $koneksi->query($query);
            } else {
                echo '<script language="javascript" type="text/javascript">
                  alert("Gagal mengupload file.!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
            }
        } else {
            echo '<script language="javascript" type="text/javascript">
              alert("Ukuran file terlalu besar.!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
        }
    }

    echo '<script language="javascript" type="text/javascript">
        alert("Data Berhasil Masuk!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>