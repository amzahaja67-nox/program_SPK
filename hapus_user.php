<?php
session_start();
include 'koneksi.php';

$id_user = mysqli_real_escape_string($koneksi,$_GET['id_user']);
mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id_user'");
header("Location: data_user.php");
exit();
?>
