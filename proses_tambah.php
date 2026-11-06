<?php
session_start();
include 'koneksi.php';

$nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
$nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat  = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

$query = "INSERT INTO mahasiswa (nim, nama, alamat, telepon) VALUES ('$nim', '$nama', '$alamat', '$telepon')";
$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_mahasiswa.php");
    exit();
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
