# Cek Kelulusan Ujian Mahasiswa

Aplikasi web sederhana berbasis **PHP Native** untuk memeriksa status kelulusan ujian mahasiswa berdasarkan nilai yang dimasukkan melalui form.

Dibuat untuk memenuhi **Tugas Pemrograman PHP** dengan materi **Struktur Kendali dan Form Processing**.

> **Universitas Trisakti**

---

## Fitur Aplikasi

- Form input data mahasiswa (Nama, Email, Nilai Ujian).
- Validasi input di sisi server menggunakan PHP:
  - Semua field wajib diisi.
  - Format email harus valid.
  - Nilai ujian harus angka antara 0 – 100.
- Penentuan status kelulusan dengan struktur kendali `if`, `elseif`, `else`:
  - **LULUS** — nilai > 70 (ditampilkan dengan warna hijau)
  - **REMEDIAL** — nilai < 70 (ditampilkan dengan warna merah)
  - **NILAI BATAS (70)** — nilai tepat 70 (ditampilkan dengan warna oranye)
- Menampilkan pesan error yang spesifik per field jika validasi gagal.
- Tampilan responsif untuk desktop dan perangkat mobile.

---

## Teknologi yang Digunakan

| Teknologi | Keterangan |
|---|---|
| PHP (Native) | Logika pemrosesan form dan struktur kendali |
| HTML5 | Struktur halaman web |
| CSS3 | Tampilan dan tata letak (file terpisah) |
| Google Fonts (Inter) | Tipografi modern |

Tidak menggunakan framework atau database.

---

## Struktur File

```
project/
├── index.php    # Halaman utama (form, validasi, dan hasil)
├── style.css    # Desain dan tata letak halaman
└── README.md    # Dokumentasi proyek ini
```

---

## Cara Menjalankan Proyek

### Pilihan 1 — Menggunakan XAMPP

1. Pastikan **XAMPP** sudah terinstal di komputer Anda.
2. Jalankan **Apache** dari XAMPP Control Panel.
3. Salin seluruh folder proyek ini ke dalam direktori:
   ```
   C:\xampp\htdocs\cek-kelulusan\
   ```
4. Buka browser dan akses:
   ```
   http://localhost/cek-kelulusan/
   ```

### Pilihan 2 — Menggunakan PHP Built-in Server

1. Pastikan **PHP** sudah terinstal dan terdaftar di PATH sistem Anda.
   - Cek dengan perintah: `php -v`
2. Buka **Terminal / Command Prompt**, lalu masuk ke direktori proyek:
   ```bash
   cd "path/ke/folder/proyek"
   ```
3. Jalankan server bawaan PHP:
   ```bash
   php -S localhost:8000
   ```
4. Buka browser dan akses:
   ```
   http://localhost:8000
   ```

---

## Contoh Hasil Pengujian

| Nama | Email | Nilai | Status yang Diharapkan |
|---|---|---|---|
| Budi Santoso | budi@email.com | **85** | ✅ **LULUS** (hijau) |
| Siti Rahma | siti@email.com | **60** | ❌ **REMEDIAL** (merah) |
| Andi Pratama | andi@email.com | **70** | ⚠️ **NILAI BATAS (70)** (oranye) |

### Contoh Kasus Validasi Gagal

| Kondisi Input | Pesan Error |
|---|---|
| Nama dikosongkan | "Nama mahasiswa wajib diisi." |
| Email salah format (`budi@`) | "Format email tidak valid. Contoh: nama@domain.com" |
| Nilai diisi huruf (`abc`) | "Nilai ujian harus berupa angka." |
| Nilai di luar jangkauan (`150`) | "Nilai ujian harus berada di antara 0 sampai 100." |

---

## Cara Mengunggah ke GitHub

Berikut langkah-langkah untuk mengunggah proyek ini ke repository GitHub Anda:

### Persiapan (hanya sekali)

1. Pastikan **Git** sudah terinstal: `git --version`
2. Pastikan Anda sudah login ke akun GitHub.

### Langkah Upload

1. **Buat repository baru** di GitHub:
   - Buka [github.com](https://github.com) → klik **New repository**
   - Beri nama, misalnya: `pemrograman-php-kelulusan`
   - Pilih **Public** atau **Private** sesuai kebutuhan
   - **Jangan** centang "Initialize this repository" (karena kita akan push dari lokal)
   - Klik **Create repository**

2. **Buka terminal** di dalam folder proyek, lalu jalankan perintah berikut satu per satu:

   ```bash
   # Inisialisasi Git di folder proyek
   git init

   # Tambahkan semua file ke staging area
   git add .

   # Buat commit pertama
   git commit -m "Initial commit: Tugas PHP Struktur Kendali dan Form Processing"

   # Hubungkan ke repository GitHub Anda
   # Ganti URL berikut dengan URL repository Anda
   git remote add origin https://github.com/USERNAME/pemrograman-php-kelulusan.git

   # Upload (push) ke GitHub
   git push -u origin main
   ```

3. Refresh halaman repository GitHub Anda — semua file sudah terunggah.

---

## Cara Menguji dari Awal

1. Jalankan server (XAMPP atau PHP built-in server) seperti di atas.
2. Buka halaman di browser.
3. **Uji validasi error**: Klik tombol "Periksa Hasil" tanpa mengisi apapun → pastikan pesan error muncul di setiap field.
4. **Uji email tidak valid**: Isi nama dan nilai, lalu isi email dengan format salah (misalnya `test@`) → pastikan pesan error email muncul.
5. **Uji nilai di luar jangkauan**: Isi nilai `150` → pastikan pesan error nilai muncul.
6. **Uji status LULUS**: Isi semua field dengan benar dan nilai `85` → pastikan muncul badge hijau "LULUS".
7. **Uji status REMEDIAL**: Ulangi dengan nilai `60` → pastikan muncul badge merah "REMEDIAL".
8. **Uji status NILAI BATAS**: Ulangi dengan nilai `70` → pastikan muncul badge oranye "NILAI BATAS (70)".
9. Klik tombol **Periksa Lagi** untuk mengisi form dari awal.

---

*Dibuat dengan PHP Native — tanpa framework, tanpa database.*
