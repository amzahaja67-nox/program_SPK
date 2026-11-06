<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';

$id_mahasiswa = mysqli_real_escape_string($koneksi, $_GET['id_mahasiswa']);
$query        = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'");
$data         = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa - SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Form Edit Data Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_edit.php">
                        <input type="hidden" name="id_mahasiswa" value="<?php echo $data['id_mahasiswa']; ?>">

                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon / HP</label>
                            <input type="text" name="telepon" class="form-control" value="<?php echo htmlspecialchars($data['telepon']); ?>" required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="data_mahasiswa.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
