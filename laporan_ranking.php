<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }
include 'koneksi.php';

$data_ranking = [];$tahun_pilih  = "";

if (isset($_GET['tahun']) && $_GET['tahun'] != '') {$tahun_pilih = mysqli_real_escape_string($koneksi,$_GET['tahun']);

    $q_agregasi = mysqli_query($koneksi, "SELECT 
        MAX(ipk) AS max_ipk, 
        MIN(pendapatan_ortu) AS min_pendapatan, 
        MAX(saudara) AS max_saudara 
        FROM pendaftaran WHERE tahun_daftar = '$tahun_pilih'");
    $agregasi = mysqli_fetch_assoc($q_agregasi);

    $max_ipk        =$agregasi['max_ipk'];
    $min_pendapatan =$agregasi['min_pendapatan'];
    $max_saudara    =$agregasi['max_saudara'];

    $sql = "SELECT pendaftaran.*, mahasiswa.nim, mahasiswa.nama 
            FROM pendaftaran 
            INNER JOIN mahasiswa ON pendaftaran.id_mahasiswa = mahasiswa.id_mahasiswa 
            WHERE pendaftaran.tahun_daftar = '$tahun_pilih'";
    $query = mysqli_query($koneksi,$sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $r_ipk        = ($max_ipk > 0) ? ($row['ipk'] /$max_ipk) : 0;
        $r_pendapatan = ($row['pendapatan_ortu'] > 0) ? ($min_pendapatan / $row['pendapatan_ortu']) : 0;
        $r_saudara    = ($max_saudara > 0) ? ($row['saudara'] /$max_saudara) : 0;

        $nilai_v = (0.40 * $r_ipk) + (0.35 * $r_pendapatan) + (0.25 * $r_saudara);

        $data_ranking[] = [
            'nim'              => $row['nim'],
            'nama'             => $row['nama'],
            'ipk'              => $row['ipk'],
            'pendapatan'       => $row['pendapatan_ortu'],
            'saudara'          => $row['saudara'],
            'nilai_preferensi' => round($nilai_v, 3)
        ];
    }

    usort($data_ranking, function ($a,$b) {
        return $b['nilai_preferensi'] <=>$a['nilai_preferensi'];
    });
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Perangkingan Beasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-print text-primary mr-2"></i>Laporan Hasil Keputusan Beasiswa</h3>
        <a href="index.php" class="btn btn-secondary shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
    </div>

    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <form method="GET" action="laporan_ranking.php" class="form-inline">
                <label class="mr-2 font-weight-bold">Pilih Tahun Periode:</label>
                <select name="tahun" class="form-control mr-3" required>
                    <option value="">-- Pilih Tahun --</option>
                    <option value="2024" <?php if($tahun_pilih == '2024') echo 'selected'; ?>>2024</option>
                    <option value="2025" <?php if($tahun_pilih == '2025') echo 'selected'; ?>>2025</option>
                    <option value="2026" <?php if($tahun_pilih == '2026') echo 'selected'; ?>>2026</option>
                </select>
                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter mr-1"></i> Tampilkan</button>
                
                <?php if ($tahun_pilih != '') { ?>
                    <button type="button" onclick="window.print()" class="btn btn-outline-dark mr-2"><i class="fas fa-print mr-1"></i> Cetak Halaman (HTML)</button>
                    <a href="cetak_pdf.php?tahun=<?php echo $tahun_pilih; ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf mr-1"></i> Cetak PDF (FPDF)</a>
                <?php } ?>
            </form>
        </div>
    </div>

    <?php if ($tahun_pilih != '') { ?>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="text-center font-weight-bold mb-4">
                Laporan Hasil Perangkingan Beasiswa Tahun <?php echo htmlspecialchars($tahun_pilih); ?>
            </h4>
            <table class="table table-bordered">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Ranking</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>IPK</th>
                        <th>Penghasilan Ortu</th>
                        <th>Jml Saudara</th>
                        <th>Nilai Preferensi (V)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($data_ranking)) {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data pendaftaran pada tahun $tahun_pilih.</td></tr>";
                    } else {
                        $no = 1;
                        foreach ($data_ranking as$row) {
                    ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nim']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td class="text-center"><?php echo $row['ipk']; ?></td>
                        <td>Rp <?php echo number_format($row['pendapatan'], 0, ',', '.'); ?></td>
                        <td class="text-center"><?php echo $row['saudara']; ?></td>
                        <td class="text-center font-weight-bold"><?php echo $row['nilai_preferensi']; ?></td>
                    </tr>
                    <?php 
                        }
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</div>

</body>
</html>
