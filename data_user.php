<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User - SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-users-cog text-primary mr-2"></i>Manajemen Pengguna Sistem (User)</h3>
        <div>
            <a href="index.php" class="btn btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
            <a href="tambah_user.php" class="btn btn-primary shadow-sm"><i class="fas fa-user-plus mr-1"></i> Tambah User</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="60">No</th>
                        <th>Username</th>
                        <th>Level Hak Akses</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT id_user, username, level FROM user ORDER BY id_user ASC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td class="font-weight-bold"><?php echo htmlspecialchars($data['username']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo ($data['level'] == 'Admin') ? 'primary' : 'info'; ?>">
                                <?php echo htmlspecialchars($data['level']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="hapus_user.php?id_user=<?php echo $data['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus akun user ini?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
