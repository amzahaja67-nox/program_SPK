<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-file-signature text-primary mr-2"></i>Data Transaksi Pendaftaran Beasiswa</h3>
        <div>
            <a href="index.php" class="btn btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
            <a href="tambah_pendaftaran.php" class="btn btn-primary shadow-sm"><i class="fas fa-plus-circle mr-1"></i> Tambah Pendaftaran</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Penghasilan Ortu (C2 - Cost)</th>
                            <th>IPK (C1 - Benefit)</th>
                            <th>Jml Saudara (C3 - Benefit)</th>
                            <th width="160" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT pendaftaran.*, mahasiswa.nim, mahasiswa.nama 
                                FROM pendaftaran 
                                INNER JOIN mahasiswa ON pendaftaran.id_mahasiswa = mahasiswa.id_mahasiswa 
                                ORDER BY pendaftaran.id_daftar DESC";
                        $query = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['tahun_daftar']; ?></td>
                            <td><?php echo htmlspecialchars($data['nim']); ?></td>
                            <td class="font-weight-bold"><?php echo htmlspecialchars($data['nama']); ?></td>
                            <td>Rp <?php echo number_format($data['pendapatan_ortu'], 0, ',', '.'); ?></td>
                            <td><?php echo $data['ipk']; ?></td>
                            <td><?php echo $data['saudara']; ?> Orang</td>
                            <td class="text-center">
                                <a href="edit_pendaftaran.php?id_daftar=<?php echo $data['id_daftar']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="hapus_pendaftaran.php?id_daftar=<?php echo $data['id_daftar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data pendaftaran ini?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
