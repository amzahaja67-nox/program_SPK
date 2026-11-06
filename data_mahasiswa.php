<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa - SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-user-graduate text-primary mr-2"></i>Data Master Mahasiswa</h3>
        <div>
            <a href="index.php" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Beranda
            </a>
            <a href="tambah_mahasiswa.php" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelMahasiswa" class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="40">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($data['nim']); ?></td>
                            <td class="font-weight-bold"><?php echo htmlspecialchars($data['nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($data['telepon']); ?></td>
                            <td class="text-center">
                                <a href="edit_mahasiswa.php?id_mahasiswa=<?php echo $data['id_mahasiswa']; ?>" class="btn btn-warning btn-sm" title="Ubah Data">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus_mahasiswa.php?id_mahasiswa=<?php echo $data['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data mahasiswa ini?')" title="Hapus Data">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabelMahasiswa').DataTable({
            "language": {
                "search": "Cari Mahasiswa:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
</body>
</html>
