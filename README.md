# FindIT — Sistem Lost & Found Universitas Jember

**FindIT** adalah aplikasi web layanan *Lost & Found* yang dikembangkan untuk lingkungan Universitas Jember (UNEJ). Aplikasi ini membantu sivitas akademika melaporkan barang hilang, mencari barang temuan, dan mengajukan klaim kepemilikan barang. Sistem juga menyediakan panel khusus bagi Petugas Pos Keamanan Utama UNEJ untuk mengelola barang temuan, memverifikasi klaim, mencatat proses serah terima, serta mencetak rekap laporan operasional.

---

## Fitur Utama

### 1. Halaman Publik dan Katalog

Halaman publik dapat diakses tanpa harus login. Halaman ini menjadi pusat informasi dan pencarian barang hilang maupun barang temuan.

- **Landing Page:** Menampilkan informasi aplikasi, hero section, panduan penggunaan dalam tiga langkah, serta informasi lokasi dan jam operasional Pos Keamanan Utama UNEJ.
- **Peta Lokasi:** Menampilkan lokasi Pos Keamanan Utama UNEJ melalui integrasi Google Maps.
- **Katalog Barang:** Menampilkan daftar barang temuan dan laporan kehilangan dalam dua tab terpisah.
- **Pencarian dan Filter:** Mendukung pencarian berdasarkan kata kunci dan penyaringan berdasarkan kategori.
- **Paginasi Dinamis:** Menggunakan HTMX untuk memperbarui daftar barang tanpa harus memuat ulang seluruh halaman.
- **Detail Barang:** Menampilkan informasi barang melalui modal menggunakan HTML Popover API.
- **Integrasi WhatsApp:** Menyediakan tautan untuk menghubungi pelapor barang hilang maupun petugas Pos Keamanan UNEJ.

### 2. Autentikasi, Hak Akses, dan Profil

Sistem autentikasi menggunakan satu halaman login yang mendukung dua jenis pengguna, yaitu mahasiswa dan petugas.

- **Login Multi-Role:** Menggunakan satu kolom input (`identifier`) yang secara otomatis mengenali NIM mahasiswa atau email petugas.
- **Remember Me:** Menyediakan fitur untuk mengingat sesi login pengguna.
- **Registrasi Mahasiswa:** Mahasiswa dapat membuat akun secara mandiri dengan mengisi nama lengkap, NIM, nomor WhatsApp, dan kata sandi.
- **Validasi Akun:** NIM mahasiswa dan email pengguna harus bersifat unik.
- **Pembatasan Hak Akses:** Middleware `RoleMiddleware` membedakan akses antara pengguna dengan role `mahasiswa` dan `petugas`.
- **Status Akun:** Akun mahasiswa yang berstatus nonaktif (`is_active = false`) tidak dapat menggunakan sistem.
- **Manajemen Profil:** Pengguna dapat memperbarui nama lengkap, nomor HP/WhatsApp, dan kata sandi melalui halaman profil.

### 3. Fitur Mahasiswa

Mahasiswa dapat menggunakan sistem untuk melaporkan kehilangan barang, mengajukan klaim, dan memantau perkembangan pengajuan.

- **Laporan Kehilangan:** Mahasiswa dapat menambahkan, melihat, mengubah, dan menghapus laporan kehilangan miliknya sendiri.
- **Foto Barang:** Laporan kehilangan mendukung unggahan foto secara opsional.
- **Pembaruan Status:** Mahasiswa dapat menandai laporan kehilangan menjadi `ditemukan`.
- **Pengajuan Klaim:** Mahasiswa dapat mengajukan klaim kepemilikan barang temuan yang tersedia dengan menyertakan keterangan ciri khusus barang.
- **Validasi Klaim:** Sistem mencegah mahasiswa mengajukan klaim aktif secara berulang pada barang yang sama.
- **Riwayat Klaim:** Mahasiswa dapat melihat seluruh pengajuan klaim beserta status verifikasinya.
- **Informasi Verifikasi:** Mahasiswa dapat membaca catatan petugas dan melihat foto bukti serah terima apabila klaim telah selesai.

Status klaim yang digunakan meliputi `pending`, `disetujui`, `ditolak`, dan `selesai`.

### 4. Panel Petugas Keamanan

Panel petugas digunakan untuk mengelola seluruh aktivitas operasional layanan Lost & Found.

- **Dashboard Operasional**

  Dashboard menampilkan enam kartu statistik utama:

  1. Barang temuan tersedia.
  2. Klaim yang menunggu verifikasi.
  3. Barang yang menunggu diambil.
  4. Barang yang sudah dikembalikan.
  5. Laporan kehilangan dengan status dicari.
  6. Jumlah mahasiswa aktif.

  Selain itu, dashboard menampilkan lima pengajuan klaim pending dan lima laporan kehilangan terbaru.

- **Kelola Barang Temuan**

  Petugas dapat melakukan pengelolaan data barang temuan, meliputi:

  1. Menambahkan data barang temuan.
  2. Mengunggah foto barang saat penambahan.
  3. Mengubah informasi barang.
  4. Menghapus data barang.
  5. Melakukan pencarian barang.
  6. Memfilter barang berdasarkan kategori dan status.
  7. Memperbarui status barang secara manual.

  Status barang temuan terdiri atas `tersedia`, `diklaim`, dan `dikembalikan`.

- **Verifikasi Klaim dan Serah Terima**

  Petugas bertanggung jawab memeriksa pengajuan klaim yang dikirimkan mahasiswa.

  1. **Menyetujui Klaim:** Mengubah status klaim menjadi `disetujui` dan status barang menjadi `diklaim`. Sistem juga otomatis menolak pengajuan klaim `pending` lainnya pada barang yang sama.
  2. **Menolak Klaim:** Petugas dapat menolak klaim dengan menyertakan alasan pada kolom `catatan_petugas`.
  3. **Membatalkan Persetujuan:** Jika klaim yang sebelumnya disetujui dibatalkan, status barang dikembalikan menjadi `tersedia`.
  4. **Menyelesaikan Klaim:** Petugas mengunggah foto bukti serah terima, sistem mencatat `tanggal_diambil` secara otomatis, dan status barang berubah menjadi `dikembalikan`.
  5. **Menghubungi Pengklaim:** Petugas dapat menghubungi mahasiswa melalui WhatsApp dengan pesan otomatis yang telah disiapkan.

- **Pantau Laporan Kehilangan**

  Petugas dapat mengelola seluruh laporan kehilangan yang masuk melalui sistem.

  Fitur yang tersedia meliputi:

  1. Pencarian berdasarkan nama barang, lokasi kehilangan, nama mahasiswa, dan NIM.
  2. Filter berdasarkan kategori dan status laporan.
  3. Badge otomatis `> 30 hr` untuk laporan berstatus `dicari` yang telah melewati 30 hari.
  4. Tombol WhatsApp dengan pesan otomatis untuk menghubungi pelapor.
  5. Pembaruan status laporan.
  6. Penghapusan laporan kehilangan.

- **Master Kategori**

  Petugas dapat mengelola kategori barang yang digunakan dalam laporan kehilangan dan barang temuan.

  Fitur pengelolaan meliputi:

  1. Menambahkan kategori.
  2. Mengubah kategori.
  3. Menghapus kategori.
  4. Validasi nama kategori agar tidak terjadi duplikasi.
  5. Proteksi penghapusan kategori yang masih digunakan oleh data lain.

- **Kelola Pengguna Mahasiswa**

  Petugas dapat melihat dan mengelola data akun mahasiswa yang terdaftar.

  Fitur yang tersedia meliputi:

  1. Pencarian berdasarkan nama, NIM, dan nomor HP.
  2. Filter berdasarkan status akun.
  3. Melihat ringkasan aktivitas laporan dan klaim mahasiswa.
  4. Menghubungi mahasiswa melalui WhatsApp.
  5. Mengaktifkan dan menonaktifkan akun melalui atribut `is_active`.

- **Rekap dan Cetak Laporan**

  Sistem menyediakan halaman rekap untuk membantu petugas memantau aktivitas operasional.

  Fitur yang tersedia meliputi:

  1. Ringkasan lima metrik operasional.
  2. Filter jenis laporan, yaitu Barang Temuan, Laporan Kehilangan, dan Verifikasi Klaim.
  3. Filter rentang tanggal.
  4. Filter status.
  5. Fitur cetak langsung menggunakan `window.print()`.
  6. Tampilan laporan yang telah disesuaikan untuk dicetak atau disimpan sebagai PDF melalui browser.

---

## Teknologi yang Digunakan

| Lapisan | Teknologi |
|---|---|
| Backend | PHP `^8.3`, Laravel `^13.17` |
| Template Engine | Laravel Blade |
| Styling | Tailwind CSS dan Modern CSS |
| Interaktivitas | HTMX `2.0.4` dan Native HTML Popover API |
| Tipografi | Google Fonts (DM Sans) |
| Database | MySQL dan SQLite |

Beberapa fitur CSS modern yang digunakan antara lain `Scroll-Driven Animations`, `scroll-target-group`, `base-select`, dan `@starting-style`.

---

## Struktur Database

FindIT menggunakan lima tabel utama untuk menyimpan data aplikasi.

| Tabel | Deskripsi | Relasi dan Kolom Utama |
|---|---|---|
| `pengguna` | Menyimpan data akun mahasiswa dan petugas. | `nama`, `nim`, `email`, `password`, `role`, `no_hp`, `is_active` |
| `kategori` | Menyimpan master kategori barang. | `nama_kategori` |
| `barang_temuan` | Menyimpan data barang yang ditemukan dan dikelola petugas. | `kategori_id`, `nama_barang`, `lokasi_ditemukan`, `tanggal_ditemukan`, `deskripsi`, `foto_barang`, `status` |
| `laporan_kehilangan` | Menyimpan laporan barang hilang yang dibuat mahasiswa. | `pengguna_id`, `kategori_id`, `nama_barang`, `lokasi_hilang`, `tanggal_hilang`, `deskripsi`, `foto_barang`, `status` |
| `klaim` | Menyimpan pengajuan dan proses verifikasi klaim barang. | `barang_temuan_id`, `pengguna_id`, `keterangan_klaim`, `status`, `catatan_petugas`, `foto_serah_terima`, `tanggal_diambil` |

**Relasi dan ketentuan data:**

- `pengguna`: NIM dan email bersifat unik.
- `kategori`: Nama kategori bersifat unik.
- `barang_temuan.kategori_id` berelasi dengan tabel `kategori`.
- `laporan_kehilangan.pengguna_id` berelasi dengan tabel `pengguna`.
- `laporan_kehilangan.kategori_id` berelasi dengan tabel `kategori`.
- `klaim.barang_temuan_id` berelasi dengan tabel `barang_temuan`.
- `klaim.pengguna_id` berelasi dengan tabel `pengguna`.

**Status data yang digunakan:**

| Data | Status |
|---|---|
| Role Pengguna | `mahasiswa`, `petugas` |
| Barang Temuan | `tersedia`, `diklaim`, `dikembalikan` |
| Laporan Kehilangan | `dicari`, `ditemukan` |
| Klaim | `pending`, `disetujui`, `ditolak`, `selesai` |

---

## Struktur Direktori Utama

```text
FindIT/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── BarangTemuanController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── HomeController.php
│   │   │   ├── KategoriController.php
│   │   │   ├── KlaimController.php
│   │   │   ├── LaporanController.php
│   │   │   ├── LaporanKehilanganController.php
│   │   │   ├── PenggunaController.php
│   │   │   └── ProfilController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── BarangTemuan.php
│       ├── Kategori.php
│       ├── Klaim.php
│       ├── LaporanKehilangan.php
│       └── User.php
├── bootstrap/
│   └── app.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── images/
│   └── seed-barang/
├── resources/
│   └── views/
│       ├── auth/
│       ├── components/
│       ├── layouts/
│       ├── mahasiswa/
│       ├── petugas/
│       ├── profil/
│       └── home.blade.php
└── routes/
    └── web.php
```

---

## Prasyarat Instalasi

Sebelum menjalankan aplikasi, pastikan perangkat telah memiliki beberapa kebutuhan berikut:

- PHP versi **8.3**.
- Composer.
- MySQL.
- Git.
- Web browser.

Aplikasi dapat dijalankan menggunakan lingkungan pengembangan lokal seperti Laragon atau XAMPP.

---

## Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan FindIT di lingkungan lokal.

### 1. Clone Repository

Buka terminal, kemudian jalankan perintah berikut:

```bash
git clone https://github.com/ardian79/FindIT.git FindIT
```

Masuk ke direktori proyek:

```bash
cd FindIT
```

### 2. Install Dependensi

Install seluruh dependensi PHP menggunakan Composer:

```bash
composer install
```

### 3. Konfigurasi File Environment

Salin file `.env.example` menjadi `.env`.

Untuk Windows Command Prompt atau PowerShell:

```bash
copy .env.example .env
```

Untuk Linux atau macOS:

```bash
cp .env.example .env
```

Buka file `.env`, kemudian sesuaikan konfigurasi database MySQL:

```env
APP_NAME=FindIT

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=findit
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database dengan nama `findit` sudah dibuat melalui MySQL sebelum melanjutkan ke tahap migrasi.

### 4. Generate Application Key dan Storage Link

Jalankan perintah berikut untuk membuat application key:

```bash
php artisan key:generate
```

Kemudian buat symbolic link untuk penyimpanan file:

```bash
php artisan storage:link
```

### 5. Jalankan Migrasi dan Seeder

Jalankan perintah berikut untuk membuat tabel database sekaligus mengisi data awal:

```bash
php artisan migrate --seed
```

Seeder akan mengisi data awal berupa:

- 6 kategori barang.
- 1 akun petugas.
- 20 akun mahasiswa.
- 20 data barang temuan.
- 20 laporan kehilangan.
- 10 data klaim.

Seeder juga akan menyalin aset foto dari direktori `public/seed-barang/` ke `storage/app/public/`.

### 6. Jalankan Server

Setelah seluruh proses instalasi selesai, jalankan server pengembangan Laravel:

```bash
php artisan serve
```

Buka browser dan akses alamat berikut:

```text
http://127.0.0.1:8000
```

**Catatan:** Tailwind CSS dan HTMX dimuat melalui CDN sehingga aplikasi tidak mewajibkan perintah `npm run dev` untuk menjalankan tampilan antarmuka.

---

## Akun Demo

Aplikasi menyediakan beberapa akun demo yang dibuat melalui proses seeding.

| Role | Identifier Login | Password | Status |
|---|---|---|---|
| Petugas | `petugas@unej.ac.id` | `petugas123` | Aktif |
| Mahasiswa | `222410101001` (Dimas Pratama Putra) | `mahasiswa123` | Aktif |
| Mahasiswa | `222410101014` (Nabila Aulia Rahma) | `mahasiswa123` | Aktif |
| Mahasiswa | `220710101042` (Wahyu Hidayatullah) | `mahasiswa123` | Nonaktif |

Akun mahasiswa nonaktif disediakan untuk menguji mekanisme pembatasan login berdasarkan status akun.

---

## Alur Kerja Sistem

Berikut alur utama penggunaan aplikasi FindIT:

### 1. Penemuan Barang

Petugas mencatat barang yang ditemukan melalui Panel Petugas dengan melengkapi informasi dan foto barang. Setelah disimpan, barang akan ditampilkan pada katalog publik dengan status `tersedia`.

### 2. Pelaporan Kehilangan

Mahasiswa melakukan login menggunakan NIM, kemudian membuat laporan kehilangan dengan mengisi informasi barang, lokasi, tanggal kehilangan, deskripsi, dan foto jika diperlukan. Laporan akan ditampilkan pada tab Barang Hilang agar dapat dipantau oleh petugas dan sivitas akademika.

### 3. Pengajuan dan Verifikasi Klaim

Mahasiswa yang merasa memiliki barang temuan dapat mengajukan klaim melalui detail barang dengan menyertakan keterangan ciri khusus sebagai bukti pendukung kepemilikan.

Petugas kemudian memeriksa pengajuan melalui menu Verifikasi Klaim untuk menyetujui atau menolak klaim tersebut.

### 4. Serah Terima Barang

Setelah klaim disetujui, mahasiswa dapat mengambil barang di Pos Keamanan Utama UNEJ dengan membawa KTM atau identitas resmi.

Petugas kemudian mengunggah foto bukti serah terima dan menyelesaikan proses klaim melalui sistem. Setelah proses selesai, status barang berubah menjadi `dikembalikan`.

---

## Penutup

FindIT dikembangkan sebagai solusi digital untuk mempermudah pengelolaan barang hilang dan temuan di lingkungan Universitas Jember. Melalui fitur pelaporan, pencarian barang, pengajuan klaim, dan verifikasi oleh petugas, diharapkan proses penemuan serta pengembalian barang dapat berjalan lebih terorganisir, efektif, dan transparan.

Dengan adanya sistem ini, FindIT diharapkan dapat membantu meningkatkan kualitas pelayanan informasi barang hilang dan temuan bagi sivitas akademika Universitas Jember.