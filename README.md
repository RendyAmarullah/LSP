
🚀 Fitur Utama

👨‍🎓 Panel Mahasiswa (Calon Mahasiswa)
Registrasi & Login: Pembuatan akun calon mahasiswa.
Pengisian Biodata: Form lengkap (Data Diri, Sekolah Asal, Upload Foto).
Pemilihan Prodi: Memilih Jurusan dan Fakultas (Data dinamis dari database).
Validasi Status: Menu terkunci otomatis jika status belum diverifikasi admin.
Sistem Pembayaran:
     Invoice otomatis berdasarkan biaya prodi yang dipilih.
     Upload bukti bayar.
     Cek status pembayaran (Pending/Lunas/Ditolak).
Dashboard Informatif:** Notifikasi status pendaftaran realtime.

👮‍♂️ Panel Admin
Dashboard Statistik: Ringkasan jumlah pendaftar, akun, dan pembayaran lunas.
Validasi Pendaftar: Melihat detail biodata, Menerima (Validasi), atau Menolak pendaftar.
Validasi Pembayaran: Memeriksa bukti transfer, mengubah status menjadi Lunas atau Ditolak (dengan alasan).
Manajemen Pengumuman: CRUD (Create, Read, Update, Delete) pengumuman kampus.
Data Master: Manajemen akun dan data lainnya.

Dependensi:
1. Backend 
- PHP versi >= 8.1
- Laravel Framework
- Composer

2. Database
- MySQL

3. Frontend
- Bootstrap 5
- FontAwesome

4. Struktur Tabel
-users: Menyimpan akun login (email, password, role: admin/mahasiswa).
-prodis: Menyimpan data master jurusan, fakultas, dan biaya kuliah.
-calon_mahasiswas: Menyimpan biodata lengkap, relasi ke users dan prodis.
-pembayarans: Menyimpan transaksi, bukti bayar, dan status pembayaran.
-pengumuman: Menyimpan berita dari admin.


Panduan Penggunaan Sistem 
1. Panduan untuk calon mahasiswa 
    1. Registrasi Akun
        1. Buka halaman utama website.
        2. Klik tombol "Daftar" atau "Register".
        3. Isi nama lengkap, email, dan password yang diinginkan.
        4. Klik tombol Daftar.
        5. Akun Anda berhasil dibuat. Silakan lanjut ke menu Login.

    2. Login ke Sistem
        1. Masukkan email dan password yang telah didaftarkan.
        2. Klik tombol "Login".
        3. Jika berhasil, Anda akan diarahkan ke Dashboard Mahasiswa.

    3. Melihat Status Pendaftaran Akun
    Setelah login, pada halaman Dashboard, pengguna dapat melihat status akun Anda saat ini.
        1. Status Awal: Biasanya akun baru akan berstatus "Pending", pada tahap ini pengguna tidak dapat mendaftar sebagai calon mahasiswa
        2. Setelah akun di validasi pengguna baru dapat melakukan pendaftaran sebagai calon mahasiswa

    4. Mengisi Formulir Pendaftaran
        1. Pada Sidebar sebelah kiri, klik menu "Data Profil" atau "Lengkapi Profil".
        2. Isi formulir dengan lengkap:
            - Data Pribadi: Nama, TTL, Agama, Jenis Kelamin, No HP, Alamat.
            - Data Akademik: Asal Sekolah.
            - Pilihan Jurusan: Pilih Fakultas dan Program Studi yang diminati.
            - Upload Foto: Unggah pas foto formal (Format JPG/PNG, Maks 2MB).
        3. Klik tombol "Kirim Formulir Pendaftaran".
        4. Data pengguna akan tersimpan dengan status "Menunggu Verifikasi".

    5. Menunggu Verifikasi Biodata
        1. Lihat pada "Status Pendaftaran".
        2. Jika status masih "Menunggu Verifikasi", pengguna belum bisa melakukan pembayaran.
        3. Jika status berubah menjadi "Ditolak", klik tombol "Perbaiki Data" dan perbarui informasi pengguna.
        4. Jika status berubah menjadi "Tervalidasi", menu Pembayaran akan terbuka.

    6. Melakukan Pembayaran (Melakukan Konfirmasi Pembayaran)
    Menu ini hanya aktif jika biodata pengguna sudah divalidasi oleh Admin.

        1. Klik menu "Pembayaran" di sidebar.
        2. Pengguna akan melihat Rincian Tagihan (Invoice) sesuai Prodi yang dipilih.
        3. Lakukan transfer ke rekening yang tertera.
        4. Foto bukti transfer Anda.
        5. Pada formulir upload, pilih file bukti transfer tersebut dan klik "Kirim Bukti Bayar".
        6. Status pembayaran akan menjadi "Menunggu Verifikasi".

    7. Melihat Pengumuman
        1. Di halaman Dashboard, gulir ke bawah untuk melihat Papan Pengumuman.
        2. Klik tombol "Baca Selengkapnya" pada kartu pengumuman untuk melihat detail informasi dan gambar. 

2. Panduan untuk Admin
    1. Login Admin
        1. Masuk ke halaman login dan login dengan akun yang memiliki role admin.
        2. Setelah login, Pengguna akan diarahkan ke Dashboard Admin.

    2. Mengelola Pengumuman
        Admin dapat membuat informasi yang akan dilihat oleh semua mahasiswa.
        1. Klik menu "Pengumuman" di sidebar.
        2. Menambah: Klik tombol "Buat Baru", isi Judul, Konten, dan Upload Gambar, lalu Simpan.
        3. Mengubah: Klik tombol Edit (ikon pensil) pada pengumuman yang ingin diubah.
        4. Menghapus: Klik tombol Hapus (ikon sampah) untuk menghapus pengumuman.

    3. Memverifikasi Akun
        Tugas ini untuk memeriksa data diri yang dikirim calon mahasiswa.
        1. Klik menu "Akun".
        2. Pengguna akan melihat tabel daftar akun yang baru register.
        3.Admin dapat mengaktifkan atau menonaktifkan akun jika diperlukan.

    4. Memverifikasi Pendaftaran Mahasiswa (Biodata)
        Tugas ini untuk memeriksa data diri yang dikirim calon mahasiswa.
        1. Klik menu "Data Pendaftar".
        2. Anda akan melihat tabel daftar calon mahasiswa.
        3. Klik tombol "Detail" pada salah satu nama.
        4. Jendela popup akan muncul menampilkan biodata dan foto.
        5. Aksi Verifikasi:
            - Terima & Validasi: Jika data sudah benar. Status mahasiswa akan berubah menjadi "Tervalidasi" (Mahasiswa bisa lanjut bayar).
            - Tolak: Jika data salah/foto tidak jelas. Status berubah menjadi "Ditolak" (Mahasiswa harus edit data).
            Setelah login, Anda akan diarahkan ke Dashboard Admin.
        
    5. Memverifikasi Pembayaran
        Tugas ini untuk memeriksa bukti transfer yang diunggah mahasiswa.
        1. Klik menu "Pembayaran" di sidebar.
        2. Lihat tabel transaksi dengan status "Pending".
        3. Klik tombol "Periksa".
        4. Lihat gambar bukti bayar dan nominal tagihan.
        5. Aksi Verifikasi:
            - Verifikasi Lunas: Jika uang sudah masuk dan nominal sesuai. Status menjadi "Lunas".
            - Tolak Pembayaran: Jika bukti palsu/buram. Anda wajib mengisi Alasan Penolakan. Status menjadi "Ditolak" (Mahasiswa harus upload ulang).



cara instalasi :
1. Pull Repository 
git pull https://github.com/Sertifikasi-Web-Developer-LSPP1-UMDP/assessment-batch-6-RendyAmarullah.git

2. Install Dependencies
composer install

3. Konfigurasi Environment
Salin file .env.example menjadi .env

4. Generate Key
php artisan key:generate

5. Migrasi Database dan Seeder
php artisan migrate --seed

6. Setup Storage
php artisan storage:link

7. Jalankan Server
php artisan serve