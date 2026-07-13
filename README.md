# E-Student LP3I Karawang 🎓⚡
> **Portal Akademik & LMS Ringan Berbasis SPA (Single Page Application)**

E-Student LP3I Karawang adalah web portal akademik sekaligus Learning Management System (LMS) yang dirancang khusus untuk memfasilitasi kebutuhan perkuliahan mahasiswa secara mobile-friendly, interaktif, dan berkinerja tinggi.

---

## 🚀 Fitur Utama
1. **Dashboard Akademik:** Pantau jadwal perkuliahan harian dan perkembangan Indeks Prestasi Semester (IPS) secara visual.
2. **Kartu Rencana Studi (KRS):** Ajukan rencana studi semester aktif dan cetak berkas KRS resmi langsung dari aplikasi.
3. **Kartu Hasil Studi (KHS):** Lihat nilai komponen detail (Kehadiran, Sikap, UTS, UAS, Formative) beserta kalkulasi nilai akhir dan predikat akademik.
4. **Materi Kuliah & Unduhan:** Akses materi ajar per mata kuliah dan unduh berkas pendukung pembelajaran dengan satu klik.
5. **Manajemen Tugas & Pengumpulan (LMS):** Cek tanggal jatuh tempo tugas perkuliahan, unduh soal, dan kumpulkan berkas jawaban (*submission*) secara terintegrasi.
6. **Notifikasi Pintar Real-Time:** Notifikasi tugas baru yang muncul secara otomatis di bar navigasi atas.

---

## 🛠️ Tech Stack & Arsitektur
Aplikasi ini dikembangkan menggunakan teknologi Laravel modern yang dioptimalkan untuk performa tinggi tanpa membutuhkan library frontend berat seperti React atau Vue:
* **Framework:** [Laravel 12.x](https://laravel.com) (PHP 8.2+)
* **Reaktivitas UI:** [Livewire v4](https://livewire.laravel.com) & [Livewire Volt](https://livewire.laravel.com/docs/volt) (Single File Component reaktif)
* **Desain UI/UX:** [Tailwind CSS](https://tailwindcss.com) & [Alpine.js](https://alpinejs.dev)
* **Build Tool & Bundler:** [Vite](https://vitejs.dev)
* **Database Driver:** SQLite / MySQL

---

## ⚡ Laporan Optimasi Performa (Juli 2026)

Aplikasi telah melalui proses audit dan optimasi menyeluruh untuk mengatasi kelambatan navigasi, kueri database berlebihan, dan konsumsi bandwidth. Berikut rincian perubahan yang telah diimplementasikan:

### 1. Migrasi ke SPA Murni (Single Page Application)
Semua rute utama kini menggunakan **Full-Page Livewire Components** dengan navigasi cerdas `wire:navigate`.
* **Dampak:** Browser tidak melakukan pemuatan ulang (*full reload*) saat berganti menu. Transisi halaman menjadi instan dan mulus layaknya aplikasi mobile native.

### 2. Eliminasi Kueri Database Berlebihan (N+1 Query)
* **Masalah Awal:** Di halaman tugas, status pengumpulan (*submission*) di-load secara berulang di dalam baris daftar tugas, memicu kueri database terpisah untuk setiap item.
* **Solusi:** Menerapkan metode **Eager Loading** (`Tugas::with(['materiAjar', 'submissionByAuth'])`). Data ditarik sekaligus dalam satu kueri terpadu.

### 3. Penghapusan Polling Agresif (Stop Database Overload)
* **Masalah Awal:** Halaman Tugas dan Materi melakukan ping/polling terus-menerus ke server setiap 5 detik (`wire:poll`).
* **Solusi:** Menghapus polling pada halaman statis. Polling hanya disisakan pada ikon notifikasi header dengan interval yang diperlonggar menjadi 30 detik (`wire:poll.30s`).

### 4. Konsolidasi CSS & Font Cache Cerdas
* **Masalah Awal:** Sub-view (KRS, KHS, Tugas, Profil) memuat tag `<style>` internal dan mengunduh ulang Google Fonts Poppins setiap kali dibuka.
* **Solusi:** Seluruh stylesheet internal dilepaskan dan disatukan ke dalam file [`resources/css/app.css`](resources/css/app.css). Font dideklarasikan di file CSS utama agar browser menyimpannya ke dalam memori cache lokal setelah kunjungan pertama.

---

## 📊 Tabel Perbandingan (Sebelum vs Sesudah)

| Metrik Evaluasi | Sebelum Optimasi 🔴 | Setelah Optimasi 🟢 |
| :--- | :--- | :--- |
| **Navigasi Halaman** | Halaman berkedip putih, sidebar menghilang sejenak (Reload penuh). | Transisi instan dan mulus menggunakan Livewire `wire:navigate`. |
| **Kueri Data Tugas** | Mengirimkan 11+ kueri database terpisah untuk 10 baris tugas. | Hanya mengirim **1 kueri terpadu** (Eager Loading). |
| **Spam AJAX ke Server** | 3 halaman × 12 request/menit per user (walau sedang diam). | **0 request** saat user sedang diam membaca halaman. |
| **Beban Bandwidth** | Mengunduh kembali file dekorasi CSS & Font yang sama setiap klik menu. | Menggunakan aset cache lokal, hemat kuota internet mahasiswa. |
| **Keamanan Font & Render** | Font berkedip/berubah bentuk saat halaman berganti (*layout jank*). | Render font konsisten dan tidak berkedip sejak detik pertama. |

---

## 💻 Panduan Instalasi Lokal

### Prasyarat
* PHP >= 8.2
* Composer
* Node.js & NPM

### Langkah Penginstalan
1. **Clone repository dan masuk ke direktori proyek:**
   ```bash
   git clone <repository-url>
   cd LP3I_MOBILE_SERVIVE
   ```

2. **Jalankan script setup otomatis:**
   Proyek ini menyediakan perintah setup instan untuk menginstal dependensi, menyalin konfigurasi lingkungan, membuat database, dan membangun aset:
   ```bash
   composer run setup
   ```

3. **Jalankan server lokal:**
   Gunakan perintah bawaan untuk menjalankan server PHP, Vite asset bundler, antrean antrean (*queue*), dan logging secara bersamaan:
   ```bash
   composer run dev
   ```
   Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---
*Dikembangkan dengan ❤️ oleh Tim Pengembang LMS & Portal Akademik LP3I.*
