<?php
// Koneksi ke database (ganti sesuai dengan pengaturan Anda)
include 'koneksi.php';

// Ambil data dari form
$surat_id = $_POST['surat_id'];
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

// Update data surat masuk di database
$query = "UPDATE tb_sm SET nomor_agenda='$nomor_agenda', kode_sm='$kode_surat', nomor_sm='$nomor_surat', tgl_surat='$tanggal_masuk', tgl_sm='$tanggal_surat', kategori='$kategori', pengirim='$pengirim_surat', perihal_surat='$perihal_surat', lampiran='$lampiran_surat', tindakan='$tindakan' WHERE id_sm=$surat_id";

if ($koneksi->query($query) === TRUE) {
    // Hapus file-file yang terkait dengan surat ini
    if (!empty($_FILES['file_pdf']['name'][0])) {
        $query = "DELETE FROM file_surat WHERE surat_id=$surat_id";
        $koneksi->query($query);
    }

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
                $query = "INSERT INTO file_surat (surat_id, nama_file) VALUES ($surat_id, '$nama_file')";
                $koneksi->query($query);
            } else {
                echo '<script language="javascript" type="text/javascript">
                  alert("File yang diubah tidak ada, maka tidak tersimpan dan file yang asli masih ada.!");</script>';
                echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
            }
        } else {
            echo '<script language="javascript" type="text/javascript">
              alert("Ukuran file terlalu besar.!");</script>';
            echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
        }
    }

    echo '<script language="javascript" type="text/javascript">
        alert("Data Berhasil Diupdate!");</script>';
    echo "<meta http-equiv='refresh' content='0; url=surat_masuk.php'>";
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>