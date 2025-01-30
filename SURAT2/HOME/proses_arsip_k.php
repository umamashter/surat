<?php
// Koneksi ke database (gantilah parameter sesuai dengan konfigurasi Anda)
include 'koneksi.php';

// Ambil data dari formulir
$sk_id = $_POST['idsk'];
$tanggal_arsip = date("Y-m-d");
$lokasi_arsip = $_POST['arsip'];

// Query untuk menyimpan data ke dalam tabel tb_arsip_surat
$insert_sql = "INSERT INTO tb_arsip_surat (sk_id, tgl_arsip, lokasi_arsip) VALUES ('$sk_id', '$tanggal_arsip', '$lokasi_arsip')";

// Jalankan query INSERT
if ($koneksi->query($insert_sql) === TRUE) {
    // Jika query INSERT berhasil, lakukan query UPDATE pada tabel tb_sk
    $update_sql = "UPDATE tb_sk SET status_arsip = 1 WHERE id_sk = '$sk_id'";
    
    // Jalankan query UPDATE
    if ($koneksi->query($update_sql) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
            alert("Surat Keluar berhasil diarsip.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=surat_keluar_p.php'>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
} else {
    echo "Error inserting record: " . $koneksi->error;
}

// Tutup koneksi
$koneksi->close();
?>