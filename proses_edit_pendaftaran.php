<?php
session_start();
include 'koneksi.php';

$id_daftar       = mysqli_real_escape_string($koneksi, $_POST['id_daftar']);
$id_mahasiswa    = mysqli_real_escape_string($koneksi, $_POST['id_mahasiswa']);
$tahun_daftar    = mysqli_real_escape_string($koneksi, $_POST['tahun_daftar']);
$pendapatan_ortu = mysqli_real_escape_string($koneksi, $_POST['pendapatan_ortu']);
$ipk             = str_replace(',', '.', mysqli_real_escape_string($koneksi, $_POST['ipk']));
$saudara         = mysqli_real_escape_string($koneksi, $_POST['saudara']);

$query = "UPDATE pendaftaran SET 
            id_mahasiswa = '$id_mahasiswa', 
            pendapatan_ortu = '$pendapatan_ortu', 
            ipk = '$ipk', 
            saudara = '$saudara',
            tahun_daftar = '$tahun_daftar'
          WHERE id_daftar = '$id_daftar'";

$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    header("Location: data_pendaftaran.php");
    exit();
} else {
    echo "Gagal mengupdate pendaftaran: " . mysqli_error($koneksi);
}
?>
