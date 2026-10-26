<?php
/**
 * index.php — Halaman Utama Cek Kelulusan Ujian Mahasiswa
 * 
 * Materi : Struktur Kendali dan Form Processing
 * Mata Kuliah : Pemrograman PHP
 * Universitas Trisakti
 *
 * Alur kerja file ini:
 * 1. Cek apakah form sudah dikirim (metode POST).
 * 2. Ambil dan sanitasi input dari form.
 * 3. Validasi setiap input; kumpulkan pesan error jika ada.
 * 4. Jika tidak ada error, tentukan status kelulusan dengan if-elseif-else.
 * 5. Tampilkan form dan hasil (jika ada) dalam satu halaman yang sama.
 */

// ============================================================
// BAGIAN 1: INISIALISASI VARIABEL
// ============================================================

// Variabel untuk menampung nilai input (agar bisa ditampilkan kembali di form)
$nama   = '';
$email  = '';
$nilai  = '';

// Array untuk menampung pesan error per field
$errors = [];

// Variabel hasil kelulusan (hanya diisi jika validasi berhasil)
$status     = null;   // 'LULUS', 'REMEDIAL', atau 'NILAI BATAS (70)'
$statusClass = null;  // kelas CSS untuk pewarnaan kotak hasil

// Flag: apakah form sudah pernah dikirim?
$formSubmitted = false;

// ============================================================
// BAGIAN 2: PEMROSESAN FORM (hanya berjalan saat form dikirim)
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formSubmitted = true;

    // --- Ambil dan bersihkan input dari form ---
    // trim() menghapus spasi di awal/akhir string
    $nama  = trim($_POST['nama']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $nilai = trim($_POST['nilai'] ?? '');

    // ---- Validasi: Nama ----
    if ($nama === '') {
        $errors['nama'] = 'Nama mahasiswa wajib diisi.';
    }

    // ---- Validasi: Email ----
    if ($email === '') {
        $errors['email'] = 'Email mahasiswa wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // filter_var() dengan FILTER_VALIDATE_EMAIL mengecek format email
        $errors['email'] = 'Format email tidak valid. Contoh: nama@domain.com';
    }

    // ---- Validasi: Nilai ----
    if ($nilai === '') {
        $errors['nilai'] = 'Nilai ujian wajib diisi.';
    } elseif (!is_numeric($nilai)) {
        // is_numeric() memastikan input adalah angka
        $errors['nilai'] = 'Nilai ujian harus berupa angka.';
    } else {
        // Ubah ke tipe float untuk perbandingan
        $nilaiAngka = (float) $nilai;

        if ($nilaiAngka < 0 || $nilaiAngka > 100) {
            $errors['nilai'] = 'Nilai ujian harus berada di antara 0 sampai 100.';
        }
    }

    // ---- Tentukan Status Kelulusan (jika tidak ada error) ----
    if (empty($errors)) {

        /**
         * Struktur Kendali: if - elseif - else
         *
         * Aturan penilaian:
         * - Nilai > 70  => LULUS
         * - Nilai < 70  => REMEDIAL
         * - Nilai == 70 => NILAI BATAS (70)
         */
        if ($nilaiAngka > 70) {
            $status      = 'LULUS';
            $statusClass = 'lulus';
        } elseif ($nilaiAngka < 70) {
            $status      = 'REMEDIAL';
            $statusClass = 'remedial';
        } else {
            // Kondisi ini tercapai saat $nilaiAngka tepat sama dengan 70
            $status      = 'NILAI BATAS (70)';
            $statusClass = 'batas';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan Ujian Mahasiswa</title>
    <meta name="description" content="Aplikasi web sederhana untuk memeriksa kelulusan ujian mahasiswa berdasarkan nilai yang dimasukkan.">
    <!-- Hubungkan file CSS eksternal -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header Halaman -->
    <div class="page-header">
        <h1>📋 Cek Kelulusan Ujian</h1>
        <p>Masukkan data mahasiswa untuk memeriksa hasil ujian</p>
    </div>

    <!-- Card Utama -->
    <div class="card">

        <p class="card-title">Form Data Mahasiswa</p>

        <?php
        // Tampilkan alert error global jika ada error setelah form dikirim
        if ($formSubmitted && !empty($errors)) :
        ?>
        <div class="alert-error">
            <strong>&#9888; Terdapat kesalahan pada input!</strong>
            Periksa kembali data yang Anda masukkan di bawah ini.
        </div>
        <?php endif; ?>

        <!--
            Form dikirim ke halaman yang sama (action="") menggunakan metode POST.
            Metode POST dipilih karena data tidak ditampilkan di URL.
        -->
        <form action="" method="POST" novalidate>

            <!-- Input: Nama Mahasiswa -->
            <div class="form-group">
                <label for="nama">Nama Mahasiswa <span style="color:#ef4444">*</span></label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    placeholder="Contoh: Budi Santoso"
                    value="<?php echo htmlspecialchars($nama); ?>"
                    class="<?php echo isset($errors['nama']) ? 'input-error' : ''; ?>"
                >
                <?php if (isset($errors['nama'])) : ?>
                    <span class="error-msg">&#9432; <?php echo htmlspecialchars($errors['nama']); ?></span>
                <?php endif; ?>
            </div>

            <!-- Input: Email Mahasiswa -->
            <div class="form-group">
                <label for="email">Email Mahasiswa <span style="color:#ef4444">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Contoh: budi@mahasiswa.trisakti.ac.id"
                    value="<?php echo htmlspecialchars($email); ?>"
                    class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>"
                >
                <?php if (isset($errors['email'])) : ?>
                    <span class="error-msg">&#9432; <?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>

            <!-- Input: Nilai Ujian -->
            <div class="form-group">
                <label for="nilai">Nilai Ujian (0 – 100) <span style="color:#ef4444">*</span></label>
                <input
                    type="number"
                    id="nilai"
                    name="nilai"
                    placeholder="Contoh: 85"
                    min="0"
                    max="100"
                    step="any"
                    value="<?php echo htmlspecialchars($nilai); ?>"
                    class="<?php echo isset($errors['nilai']) ? 'input-error' : ''; ?>"
                >
                <?php if (isset($errors['nilai'])) : ?>
                    <span class="error-msg">&#9432; <?php echo htmlspecialchars($errors['nilai']); ?></span>
                <?php endif; ?>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn-submit" id="btn-periksa">
                Periksa Hasil
            </button>

        </form>

        <?php
        // Tampilkan kotak hasil HANYA jika validasi berhasil ($status tidak null)
        if ($status !== null) :
        ?>
        <div class="result-box <?php echo $statusClass; ?>">
            <h2>&#10003; Hasil Pemeriksaan</h2>

            <div class="result-row">
                <span class="label">Nama Mahasiswa</span>
                <!-- htmlspecialchars() mencegah karakter HTML berbahaya dari input pengguna -->
                <span class="value"><?php echo htmlspecialchars($nama); ?></span>
            </div>

            <div class="result-row">
                <span class="label">Email</span>
                <span class="value"><?php echo htmlspecialchars($email); ?></span>
            </div>

            <div class="result-row">
                <span class="label">Nilai Ujian</span>
                <span class="value"><?php echo htmlspecialchars($nilai); ?></span>
            </div>

            <div class="result-row">
                <span class="label">Status Kelulusan</span>
                <span class="value">
                    <span class="badge-status badge-<?php echo $statusClass; ?>">
                        <?php echo htmlspecialchars($status); ?>
                    </span>
                </span>
            </div>

            <!-- Tombol untuk mengisi ulang form -->
            <a href="index.php" class="btn-reset">&#8635; Periksa Lagi</a>
        </div>
        <?php endif; ?>

    </div><!-- /.card -->

    <!-- Footer -->
    <div class="page-footer">
        Tugas Pemrograman PHP &mdash; Struktur Kendali &amp; Form Processing &bull; Universitas Trisakti
    </div>

</body>
</html>
