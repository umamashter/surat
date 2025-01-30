<?php
// Koneksi ke database
include 'koneksi.php';

// Data yang akan disimpan ke tb_arsip
$sm_id = $_POST['ids'];
$tanggal_arsip = date("Y-m-d");
$lokasi_arsip = $_POST['arsip'];

// Query untuk menyimpan data ke tb_arsip
$sql_insert_arsip = "INSERT INTO tb_arsip_surat (sm_id, tgl_arsip, lokasi_arsip) VALUES ('$sm_id', '$tanggal_arsip', '$lokasi_arsip')";

// Jalankan query penyimpanan data ke tb_arsip
if ($koneksi->query($sql_insert_arsip) === TRUE) {

    // Query untuk mengupdate status di tb_disposisi
    $sql_update_disposisi = "UPDATE tb_disposisi SET status_dispo = 1 WHERE sm_id = '$sm_id'";
    
    // Jalankan query pembaruan status di tb_disposisi
    if ($koneksi->query($sql_update_disposisi) === TRUE) {
        echo '<script language="javascript" type="text/javascript">
          alert("Surat Masuk berhasil diarsip.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=surat_masuk_p.php'>";
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
} else {
    echo "Error inserting record: " . $koneksi->error;
}

// Tutup koneksi
$koneksi->close();
?>