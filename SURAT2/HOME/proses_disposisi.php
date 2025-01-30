<?php 
include 'koneksi.php';

$ids = $_POST['ids'];
$disposisi = $_POST['disposisi'];
$tujuan = $_POST['tujuan'];
$catatan = $_POST['catatan'];

$catatan_dispo = implode("<br>", $catatan);

//simpan data disposisi
$query = "INSERT INTO tb_disposisi (sm_id, tujuan_disposisi, catatan) VALUES ('$ids', '$tujuan', '$catatan_dispo')";
$koneksi->query($query);

//update data status surat masuk
$query = "UPDATE tb_sm SET disposisi='$disposisi', status='3' WHERE id_sm=$ids";
$koneksi->query($query);

echo '<script language="javascript" type="text/javascript">
alert("Data Disposisikan !");</script>';
echo "<meta http-equiv='refresh' content='0; url=pimpinan_surat.php'>";
?>