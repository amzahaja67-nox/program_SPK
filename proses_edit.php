<?php
session_start();
include 'koneksi.php';

$id_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
$nim          = mysqli_real_escape_string($koneksi, $_POST['nim']);
$nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat       = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$telepon      = mysqli_real_escape_string($koneksi, $_POST['telepon']);

$query = "UPDATE mahasiswa SET 
            nim = '$nim', 
            nama = '$nama', 
            alamat = '$alamat', 
            telepon = '$telepon' 
          WHERE id_mahasiswa = '$id_mahasiswa'";

$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_mahasiswa.php");
    exit();
} else {
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}
?>
