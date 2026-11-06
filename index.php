<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SPK Penerimaan Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="index.php"><i class="fas fa-award mr-2"></i>SPK BEASISWA (SAW)</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>

                <?php if ($_SESSION['level'] == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="data_mahasiswa.php">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_pendaftaran.php">Data Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_user.php">Data User</a>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="perangkingan.php">Perangkingan SAW</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="laporan_ranking.php">Laporan & Cetak PDF</a>
                </li>
            </ul>
            <span class="navbar-text text-white mr-3">
                Halo, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b> (<?php echo $_SESSION['level']; ?>)
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin keluar?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron bg-white shadow-sm border">
        <h1 class="display-4">Sistem Pendukung Keputusan</h1>
        <p class="lead">Aplikasi Seleksi Penerimaan Beasiswa Mahasiswa Menggunakan Metode <b>Simple Additive Weighting (SAW)</b> — Universitas Graha Karya Muara Bulian.</p>
        <hr class="my-4">
        <p>Anda saat ini masuk dengan hak akses <b><?php echo $_SESSION['level']; ?></b>. Silakan gunakan menu navigasi di atas untuk mengelola data atau mencetak laporan hasil keputusan.</p>
    </div>
</div>

</body>
</html>
