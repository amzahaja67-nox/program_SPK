<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem SPK Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; }
    </style>
</head>
<body class="bg-dark">

<div class="card login-card shadow-lg border-0">
    <div class="card-header bg-primary text-white text-center py-3">
        <h4 class="mb-0">LOGIN SPK BEASISWA</h4>
        <small>Metode Simple Additive Weighting (SAW)</small>
    </div>
    <div class="card-body p-4">
        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') { ?>
            <div class="alert alert-danger text-center">Username atau Password salah!</div>
        <?php } ?>

        <form method="POST" action="proses_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan Username" autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Masuk (Login)</button>
        </form>
    </div>
</div>

</body>
</html>
