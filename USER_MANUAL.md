# BUKU PANDUAN PENGGUNA (USER MANUAL)
**Aplikasi Web Sistem Pendukung Keputusan (SPK) Penerimaan Beasiswa**  
*Metode Simple Additive Weighting (SAW)*

---

### 1. Spesifikasi Kebutuhan Sistem
* **Server Lokal:** XAMPP (Apache Web Server & MySQL Database aktif).
* **Direktori Proyek:** `C:\xampp\htdocs\beasiswa\`
* **Database:** `db_beasiswa` (Impor melalui file `db_beasiswa.sql` di phpMyAdmin).

### 2. Daftar Akun Default (Login)
| Level Akses | Username | Password | Hak Akses Modul |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin` | `admin123` | Akses penuh (CRUD Mahasiswa, Pendaftaran, User, Perangkingan SAW, & Cetak PDF). |
| **Pimpinan** | `pimpinan` | `pimpinan123` | Akses terbatas (Melihat Perangkingan SAW & Cetak Laporan PDF). |
