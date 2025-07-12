# Website Restoran Sederhana
Selamat datang di repositori Website Restoran Sederhana. Proyek ini merupakan sebuah platform pemesanan makanan online yang dibangun menggunakan PHP dan MySQL. Aplikasi ini dirancang untuk memfasilitasi alur kerja restoran dengan membagi hak akses ke dalam empat peran utama: **Administrator**, **Kasir**, **Pelayan**, dan **Pelanggan**.

## Fitur-fitur
Berikut adalah rincian fitur untuk setiap peran:

### Fitur Administrator
* **Login & Logout**
* **Dashboard**
* **Manajemen Akun (CRUD)**: Membuat, Mengedit, Menghapus semua jenis akun.
* **Manajemen Menu (CRUD)**: Membuat, Mengedit, Menghapus menu.
* **Manajemen Transaksi**: Membuat dan melihat riwayat transaksi.

### Fitur Kasir dan Pelayan
* **Login & Logout**
* **Lihat Daftar Akun**: Akses hanya-lihat (read-only).
* **Manajemen Menu (CRUD)**: Membuat, Mengedit, Menghapus menu.
* **Manajemen Transaksi**: Membuat dan melihat riwayat transaksi.

### Fitur Pelanggan
* **Login & Logout**
* **Lihat Menu**
* **Pemesanan / Membuat Transaksi**

## Teknologi yang Digunakan
* **Frontend**: HTML, CSS (Bootstrap 5), dan Javascript
* **Backend**: PHP
* **Database**: MySQL

## Cara Menjalankan Proyek Secara Lokal
Untuk menjalankan proyek ini, ikuti langkah-langkah berikut:

1.  **Clone Repositori**:
    ```bash
    git clone https://github.com/idrmdhni/PraktikumWebDasar-Restoran.git
    ```
2.  **Pindahkan ke Direktori Web Server**:
    Pindahkan folder proyek ke dalam direktori `htdocs` (jika menggunakan XAMPP) atau `www` (jika menggunakan WAMP).
3.  **Setup Database**:
    * Buka **phpMyAdmin** melalui browser (`http://localhost/phpmyadmin`).
    * Klik **"Baru"** atau **"New"** untuk membuat database.
    * Masukkan nama database, yaitu `restoran` (pastikan nama ini sesuai dengan yang ada di file `koneksi.php`). Klik **"Buat"** atau **"Create"**.
    * Setelah database dibuat, pilih database tersebut dari daftar di sebelah kiri.
    * Klik tab **"Impor"** atau **"Import"**.
    * Klik **"Choose File"** dan cari file `restoran.sql` di dalam folder proyek.
    * Klik tombol **"Kirim"** atau **"Go"** di bagian bawah halaman untuk memulai proses impor. Tunggu hingga proses selesai.

4.  **Jalankan Web Server**:
    Jalankan modul Apache dan MySQL melalui control panel XAMPP/WAMP.

5.  **Buka Aplikasi**:
    Buka browser dan akses proyek melalui URL:
    ```
    http://localhost/PraktikumWebDasar-Restoran
    ```

## Cara Login
Anda dapat menggunakan akun default berikut untuk masuk ke dalam sistem. Pastikan data ini sudah ada di dalam database setelah proses impor.
* **Administrator**:
    * **Username**: admin
    * **Password**: admin123
* **Kasir**:
    * **Username**: kasir
    * **Password**: kasir123
* **Pelayan**:
    * **Username**: pelayan
    * **Password**: pelayan123
* **Pelanggan**:
    * **Username**: pelanggan
    * **Password**: pelanggan123
