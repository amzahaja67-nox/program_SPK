<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Pendaftaran Kriteria Beasiswa</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_tambah_pendaftaran.php">
                        <div class="form-group">
                            <label>Pilih Mahasiswa</label>
                            <select name="id_mahasiswa" class="form-control" required>
                                <option value="">-- Pilih Nama Mahasiswa --</option>
                                <?php
                                $query_mhs = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nama ASC");
                                while ($mhs = mysqli_fetch_array($query_mhs)) {
                                    echo "<option value='{$mhs['id_mahasiswa']}'>{$mhs['nim']} - {$mhs['nama']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Pendaftaran</label>
                            <select name="tahun_daftar" class="form-control" required>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026" selected>2026</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penghasilan Orang Tua (Rp)</label>
                            <input type="number" name="pendapatan_ortu" class="form-control" required placeholder="Contoh: 2500000">
                        </div>
                        <div class="form-group">
                            <label>IPK Terakhir (Gunakan titik untuk desimal)</label>
                            <input type="number" step="0.01" min="0" max="4.00" name="ipk" class="form-control" required placeholder="Contoh: 3.75">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Tanggungan Saudara</label>
                            <input type="number" name="saudara" class="form-control" required placeholder="Contoh: 3">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Simpan Pendaftaran</button>
                        <a href="data_pendaftaran.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
