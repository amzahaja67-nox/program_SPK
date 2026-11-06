<?php
session_start();
include 'koneksi.php';

$id_mahasiswa    = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
$tahun_daftar    = mysqli_real_escape_string($koneksi, $_POST['tahun_daftar']);
$pendapatan_ortu = mysqli_real_escape_string($koneksi, $_POST['pendapatan_ortu']);
$ipk             = str_replace(',', '.', mysqli_real_escape_string($koneksi, $_POST['ipk']));
$saudara         = mysqli_real_escape_string($koneksi, $_POST['saudara']);

$query = "INSERT INTO pendaftaran (id_mahasiswa, pendapatan_ortu, ipk, saudara, tahun_daftar) 
          VALUES ('$id_mahasiswa', '$pendapatan_ortu', '$ipk', '$saudara', '$tahun_daftar')";

$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_pendaftaran.php");
    exit();
} else {
    echo "Gagal menyimpan pendaftaran: " . mysqli_error($koneksi);
}
?>
