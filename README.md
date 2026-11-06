# SPK Penerimaan Beasiswa (SAW)

Aplikasi web untuk membantu proses seleksi penerima beasiswa mahasiswa di Universitas Graha Karya Muara Bulian. Sistem menghitung dan mengurutkan calon penerima menggunakan metode **Simple Additive Weighting (SAW)** berdasarkan IPK, pendapatan orang tua, dan jumlah saudara.

## Fitur

- Mengelola data mahasiswa, pendaftaran, dan pengguna.
- Menghitung normalisasi serta nilai preferensi SAW.
- Menampilkan peringkat dan mencetak laporan PDF.
- Hak akses Admin dan Pimpinan.

## Menjalankan aplikasi

1. Pasang dan jalankan Apache serta MySQL melalui XAMPP.
2. Salin folder proyek ke `C:\xampp\htdocs\beasiswa`.
3. Buat database MySQL bernama `db_beasiswa`, lalu siapkan tabel dan data yang diperlukan aplikasi.
4. Sesuaikan host, username, password, dan nama database pada `koneksi.php` bila konfigurasi Anda berbeda.
5. Buka `http://localhost/beasiswa` di browser.

## Akun bawaan

| Hak akses | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |
| Pimpinan | `pimpinan` | `pimpinan123` |

Ganti kata sandi bawaan sebelum aplikasi digunakan di lingkungan produksi. Panduan penggunaan lebih lengkap tersedia di [USER_MANUAL.md](USER_MANUAL.md).
