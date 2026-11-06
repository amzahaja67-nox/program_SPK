<?php
session_start();
include 'koneksi.php';

$id_daftar = mysqli_real_escape_string($koneksi, $_GET['id_daftar']);
$query     = "DELETE FROM pendaftaran WHERE id_daftar = '$id_daftar'";
$hasil     = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_pendaftaran.php");
    exit();
} else {
    echo "Gagal menghapus pendaftaran: " . mysqli_error($koneksi);
}
?>
