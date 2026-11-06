<?php
require('fpdf/fpdf.php');
include 'koneksi.php';

$tahun = isset($_GET['tahun']) ? mysqli_real_escape_string($koneksi,$_GET['tahun']) : date('Y');

$pdf = new FPDF('P', 'mm', 'A4');$pdf->AddPage();

// 1. KOP SURAT INSTITUSI
$pdf->SetFont('Arial', 'B', 14);$pdf->Cell(190, 7, 'UNIVERSITAS GRAHA KARYA MUARA BULIAN', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);$pdf->Cell(190, 7, 'LAPORAN HASIL PERANGKINGAN BEASISWA TAHUN ' . $tahun, 0, 1, 'C');$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'Metode Simple Additive Weighting (SAW)', 0, 1, 'C');$pdf->Ln(3);
$pdf->Cell(190, 0, '', 'T', 1, 'C');$pdf->Ln(5);

// 2. HEADER TABEL PDF
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(220, 220, 220);$pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'NIM', 1, 0, 'C', true);$pdf->Cell(75, 10, 'Nama Mahasiswa', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Nilai Preferensi', 1, 0, 'C', true);$pdf->Cell(30, 10, 'Ranking', 1, 1, 'C', true);

// 3. KOMPUTASI SAW & LOOPING BARIS PDF
$q_agregasi = mysqli_query($koneksi, "SELECT 
    MAX(ipk) AS max_ipk, 
    MIN(pendapatan_ortu) AS min_pendapatan, 
    MAX(saudara) AS max_saudara 
    FROM pendaftaran WHERE tahun_daftar = '$tahun'");
$agregasi = mysqli_fetch_assoc($q_agregasi);

$max_ipk        =$agregasi['max_ipk'];
$min_pendapatan =$agregasi['min_pendapatan'];
$max_saudara    =$agregasi['max_saudara'];

$data_ranking = [];$sql = "SELECT pendaftaran.*, mahasiswa.nim, mahasiswa.nama 
        FROM pendaftaran 
        INNER JOIN mahasiswa ON pendaftaran.id_mahasiswa = mahasiswa.id_mahasiswa 
        WHERE pendaftaran.tahun_daftar = '$tahun'";
$query = mysqli_query($koneksi,$sql);

while ($row = mysqli_fetch_assoc($query)) {
    $r_ipk        = ($max_ipk > 0) ? ($row['ipk'] /$max_ipk) : 0;
    $r_pendapatan = ($row['pendapatan_ortu'] > 0) ? ($min_pendapatan / $row['pendapatan_ortu']) : 0;
    $r_saudara    = ($max_saudara > 0) ? ($row['saudara'] /$max_saudara) : 0;

    $nilai_v = (0.40 * $r_ipk) + (0.35 * $r_pendapatan) + (0.25 * $r_saudara);

    $data_ranking[] = [
        'nim'              => $row['nim'],
        'nama'             => $row['nama'],
        'nilai_preferensi' => round($nilai_v, 3)
    ];
}

usort($data_ranking, function ($a,$b) {
    return $b['nilai_preferensi'] <=>$a['nilai_preferensi'];
});

$pdf->SetFont('Arial', '', 10);$no      = 1;
$ranking = 1;

foreach ($data_ranking as$item) {
    $pdf->Cell(15, 8,$no++, 1, 0, 'C');
    $pdf->Cell(35, 8,$item['nim'], 1, 0, 'C');
    $pdf->Cell(75, 8, ' ' .$item['nama'], 1, 0, 'L');
    $pdf->Cell(35, 8,$item['nilai_preferensi'], 1, 0, 'C');
    $pdf->Cell(30, 8, 'Peringkat ' .$ranking++, 1, 1, 'C');
}

$pdf->Ln(15);
$pdf->Cell(130, 6, '', 0, 0);$pdf->Cell(60, 6, 'Muara Bulian, ' . date('d-m-Y'), 0, 1, 'C');
$pdf->Cell(130, 6, '', 0, 0);$pdf->Cell(60, 6, 'Pimpinan / Ketua Seleksi,', 0, 1, 'C');
$pdf->Ln(20);$pdf->SetFont('Arial', 'BU', 10);
$pdf->Cell(130, 6, '', 0, 0);$pdf->Cell(60, 6, '( ............................................ )', 0, 1, 'C');

$pdf->Output('I', 'Laporan_SPK_Beasiswa_' .$tahun . '.pdf');
?>
