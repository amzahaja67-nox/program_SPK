<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';

// TAHAP 1: MENCARI NILAI MAX (BENEFIT) & MIN (COST) DARI TABEL PENDAFTARAN
$query_agregasi = mysqli_query($koneksi, "SELECT 
    MAX(ipk) AS max_ipk, 
    MIN(pendapatan_ortu) AS min_pendapatan, 
    MAX(saudara) AS max_saudara 
    FROM pendaftaran");

$data_agregasi  = mysqli_fetch_assoc($query_agregasi);
$max_ipk        = $data_agregasi['max_ipk'];
$min_pendapatan = $data_agregasi['min_pendapatan'];
$max_saudara    = $data_agregasi['max_saudara'];

// Definisi Bobot Kriteria (Total = 1.00)
$bobot_ipk        = 0.40; // Benefit
$bobot_pendapatan = 0.35; // Cost
$bobot_saudara    = 0.25; // Benefit

// TAHAP 2: MENGHITUNG NORMALISASI (R) DAN NILAI PREFERENSI (V)
$data_ranking = [];
mysqli_query($koneksi, "TRUNCATE TABLE ranking");

$sql_data = "SELECT pendaftaran.*, mahasiswa.nim, mahasiswa.nama 
             FROM pendaftaran 
             INNER JOIN mahasiswa ON pendaftaran.id_mahasiswa = mahasiswa.id_mahasiswa";
$query_data = mysqli_query($koneksi, $sql_data);

while ($row = mysqli_fetch_assoc($query_data)) {
    $r_ipk        = ($max_ipk > 0) ? ($row['ipk'] / $max_ipk) : 0;
    $r_pendapatan = ($row['pendapatan_ortu'] > 0) ? ($min_pendapatan / $row['pendapatan_ortu']) : 0;
    $r_saudara    = ($max_saudara > 0) ? ($row['saudara'] / $max_saudara) : 0;

    $nilai_v = ($bobot_ipk * $r_ipk) + ($bobot_pendapatan * $r_pendapatan) + ($bobot_saudara * $r_saudara);

    $r_ipk_bulat        = round($r_ipk, 3);
    $r_pendapatan_bulat = round($r_pendapatan, 3);
    $r_saudara_bulat    = round($r_saudara, 3);
    $nilai_v_bulat      = round($nilai_v, 3);

    $id_daftar = $row['id_daftar'];
    mysqli_query($koneksi, "INSERT INTO ranking (id_daftar, nilai_pendapatan, nilai_ipk, nilai_saudara, nilai_preferensi) 
                            VALUES ('$id_daftar', '$r_pendapatan_bulat', '$r_ipk_bulat', '$r_saudara_bulat', '$nilai_v_bulat')");

    $data_ranking[] = [
        'nim'              => $row['nim'],
        'nama'             => $row['nama'],
        'r_ipk'            => $r_ipk_bulat,
        'r_pendapatan'     => $r_pendapatan_bulat,
        'r_saudara'        => $r_saudara_bulat,
        'nilai_preferensi' => $nilai_v_bulat
    ];
}

// TAHAP 3: MENGURUTKAN ARRAY BERDASARKAN NILAI PREFERENSI (DESCENDING)
usort($data_ranking, function ($a, $b) {
    return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
});
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perhitungan & Perangkingan SAW</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-calculator text-success mr-2"></i>Hasil Komputasi Metode SAW & Perangkingan</h3>
        <a href="index.php" class="btn btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
    </div>

    <div class="alert alert-info shadow-sm">
        <strong>Parameter Agregasi Saat Ini:</strong> 
        Max IPK (Benefit): <b><?php echo $max_ipk ?? 0; ?></b> | 
        Min Pendapatan Ortu (Cost): <b>Rp <?php echo number_format($min_pendapatan ?? 0, 0, ',', '.'); ?></b> | 
        Max Saudara (Benefit): <b><?php echo $max_saudara ?? 0; ?> Orang</b>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tabel Normalisasi (R) dan Nilai Preferensi Akhir (V)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Ranking</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>R1 (IPK)<br><small>Bobot: 0.40</small></th>
                            <th>R2 (Pendapatan)<br><small>Bobot: 0.35</small></th>
                            <th>R3 (Saudara)<br><small>Bobot: 0.25</small></th>
                            <th>Nilai Preferensi (V)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($data_ranking)) {
                            echo "<tr><td colspan='7' class='text-center'>Belum ada data pendaftaran untuk dihitung.</td></tr>";
                        } else {
                            $peringkat = 1;
                            foreach ($data_ranking as $item) {
                                $badge = ($peringkat == 1) ? "class='table-success font-weight-bold'" : "";
                        ?>
                        <tr <?php echo $badge; ?>>
                            <td class="text-center"><?php echo $peringkat++; ?></td>
                            <td><?php echo htmlspecialchars($item['nim']); ?></td>
                            <td><?php echo htmlspecialchars($item['nama']); ?></td>
                            <td class="text-center"><?php echo $item['r_ipk']; ?></td>
                            <td class="text-center"><?php echo $item['r_pendapatan']; ?></td>
                            <td class="text-center"><?php echo $item['r_saudara']; ?></td>
                            <td class="text-center text-primary font-weight-bold"><?php echo $item['nilai_preferensi']; ?></td>
                        </tr>
                        <?php 
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
