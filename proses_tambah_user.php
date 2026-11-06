<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);$password = md5($_POST['password']);$level    = mysqli_real_escape_string($koneksi,$_POST['level']);

$query = "INSERT INTO user (username, password, level) VALUES ('$username', '$password', '$level')";
$hasil = mysqli_query($koneksi,$query);

if ($hasil) {
    header("Location: data_user.php");
    exit();
} else {
    echo "Gagal menambah user: " . mysqli_error($koneksi);
}
?>
