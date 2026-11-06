<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa - SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Tambah Data Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_tambah.php">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" required placeholder="Masukkan NIM">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Mahasiswa">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required placeholder="Masukkan Alamat Lengkap"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon / HP</label>
                            <input type="text" name="telepon" class="form-control" required placeholder="Contoh: 08123456789">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="data_mahasiswa.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
