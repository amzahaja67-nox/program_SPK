<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User - SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Tambah Pengguna Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_tambah_user.php">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
                        </div>
                        <div class="form-group">
                            <label>Level Hak Akses</label>
                            <select name="level" class="form-control" required>
                                <option value="Admin">Admin</option>
                                <option value="Pimpinan">Pimpinan</option>
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Simpan User</button>
                        <a href="data_user.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
