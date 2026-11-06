<?php
session_start();
include 'koneksi.php';

$id_mahasiswa = mysqli_real_escape_string($koneksi, $_GET['id_mahasiswa']);
$query        = "DELETE FROM mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
$hasil        = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_mahasiswa.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
