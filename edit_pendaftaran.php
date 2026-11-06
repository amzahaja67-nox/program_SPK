<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';

$id_daftar  = mysqli_real_escape_string($koneksi, $_GET['id_daftar']);
$query_lama = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id_daftar = '$id_daftar'");
$data_lama  = mysqli_fetch_array($query_lama);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Form Edit Data Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_edit_pendaftaran.php">
                        <input type="hidden" name="id_daftar" value="<?php echo $data_lama['id_daftar']; ?>">

                        <div class="form-group">
                            <label>Pilih Mahasiswa</label>
                            <select name="id_mahasiswa" class="form-control" required>
                                <?php
                                $query_mhs = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nama ASC");
                                while ($data_mhs = mysqli_fetch_array($query_mhs)) {
                                    $selected = ($data_mhs['id_mahasiswa'] == $data_lama['id_mahasiswa']) ? 'selected' : '';
                                    echo "<option value='{$data_mhs['id_mahasiswa']}' $selected>{$data_mhs['nim']} - {$data_mhs['nama']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun Pendaftaran</label>
                            <select name="tahun_daftar" class="form-control" required>
                                <option value="2024" <?php if($data_lama['tahun_daftar'] == '2024') echo 'selected'; ?>>2024</option>
                                <option value="2025" <?php if($data_lama['tahun_daftar'] == '2025') echo 'selected'; ?>>2025</option>
                                <option value="2026" <?php if($data_lama['tahun_daftar'] == '2026') echo 'selected'; ?>>2026</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penghasilan Orang Tua (Rp)</label>
                            <input type="number" name="pendapatan_ortu" class="form-control" value="<?php echo $data_lama['pendapatan_ortu']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>IPK Terakhir</label>
                            <input type="number" step="0.01" min="0" max="4.00" name="ipk" class="form-control" value="<?php echo $data_lama['ipk']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Tanggungan Saudara</label>
                            <input type="number" name="saudara" class="form-control" value="<?php echo $data_lama['saudara']; ?>" required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="data_pendaftaran.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
