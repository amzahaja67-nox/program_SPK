<?php
$host     = "localhost";
$user     = "root";
$password = "";
$database = "db_beasiswa";

// Melakukan koneksi ke database menggunakan mysqli
$koneksi = mysqli_connect($host, $user, $password, $database);

// Pengecekan if-else jika koneksi gagal
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
