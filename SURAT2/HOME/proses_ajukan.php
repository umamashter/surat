<?php 
include 'koneksi.php';

$id = $_POST['ids'];
$ajukan = $_POST['ajukan'];

//simpan data ajukan
$query = "INSERT INTO tb_ajukan (pg_id) VALUES ('$ajukan')";
$koneksi->query($query);

//update data status surat masuk
$query = "UPDATE tb_sm SET status='2' WHERE id_sm=$id";
$koneksi->query($query); 

echo '<script language="javascript" type="text/javascript">
alert("Data Di ajukan !!");</script>';
echo "<meta http-equiv='refresh' content='0; url=umum_surat.php'>";
?>