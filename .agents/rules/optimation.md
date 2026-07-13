---
trigger: always_on
---

1. Menghapus wire:poll yang tidak perlu dan mengoptimasi query N+1 pada DaftarTugas dan DaftarMateri.
2. Mengubah rute halaman agar menggunakan Full-Page Livewire Components sehingga transisi halaman menjadi SPA murni.
3. Pindah ke <x-app-layout>: Sangat direkomendasikan. Ini adalah standar Laravel modern dan membuat transisi halaman SPA Livewire lebih konsisten.
4. Bersihkan Sub-View: Hapus tag <style> dan @import font yang terduplikat di dalam file sub-view (seperti di 
krs/index.blade.php). Pindahkan style khusus ke file CSS utama atau buat kelas utilitas Tailwind baru jika memungkinkan.
5. Hapus styling yang dirasa berlebihan dan memberatkan browser.
6. Perbaiki juga filtering materi dan tugas agar matakuliah yang ada hanya mata kuliah yang ada di id_kelas dan id_program_studi mahasiswa saja(tapi buat tidak ada delay dalam proses filtering).
7. Buat juga supaya jika ada tugas, materi, dan pengumuman baru agar user tidak merefresh halaman.

Pastikan kamu tidak mengganggu semua fitur yang dibuat dan bagian database atau melakukan migrate, karena database project ini dipakai bersama-sama dengan bagian aplikasi yang lain.