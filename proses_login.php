<?php
session_start();
include 'koneksi.php';

$username_post = mysqli_real_escape_string($koneksi, $_POST['username']);
$password_post = mysqli_real_escape_string($koneksi, $_POST['password']);
$password_md5  = md5($password_post);

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username_post' AND password = '$password_md5'");
$cek   = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['username'] = $data['username'];
    $_SESSION['level']    = $data['level'];
    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?pesan=gagal");
    exit();
}
?>
