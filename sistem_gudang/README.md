# 📦 Sistem Penyewaan Gudang

![Sistem Gudang Screenshot](https://i0.wp.com/shipper.id/wp-content/uploads/2023/09/Gudang-dan-Warehouse-Management-System-Ketahui-Perbedaannya-di-Sini.webp?fit=1024%2C683&ssl=1)

## Deskripsi Aplikasi

Sistem Penyewaan Gudang adalah aplikasi berbasis web yang dirancang untuk memfasilitasi pengelolaan gudang dan barang-barang di dalamnya. Aplikasi ini memiliki sistem peran pengguna (Operator dan Pengguna) untuk memisahkan fungsionalitas. Operator bertanggung jawab untuk membuat dan mengelola data gudang serta barang, sementara Pengguna dapat melihat detail gudang yang mereka sewa beserta daftar barang di dalamnya.

## ✨ Fitur Utama

-   **Sistem Login Berbasis Peran:** Memisahkan akses dan fungsionalitas antara `Operator` dan `Pengguna`.
-   **Manajemen Gudang (Operator):**
    -   Membuat gudang baru.
    -   Mengedit detail gudang (penyewa, tanggal sewa, lokasi).
    -   Menambahkan barang ke gudang.
    -   Menghapus barang dari gudang.
-   **Dashboard Pengguna (Pengguna):**
    -   Melihat detail gudang yang disewa.
    -   Melihat daftar barang yang tersimpan di gudang mereka.
-   **Manajemen Data:** Penyimpanan data gudang, barang, dan pengguna terintegrasi dengan database.

## 🚀 Teknologi yang Digunakan

-   **PHP:** Sebagai bahasa pemrograman sisi server untuk logika aplikasi dan interaksi database.
-   **MySQL/MariaDB:** Sebagai sistem manajemen database untuk menyimpan semua data aplikasi.
-   **HTML:** Untuk struktur halaman web.
-   **CSS:** Untuk styling dasar antarmuka pengguna.

## 📋 Syarat (Prasyarat)

Untuk menjalankan aplikasi ini, Anda memerlukan lingkungan server web yang mendukung PHP dan database MySQL/MariaDB. Contohnya:

-   **Server Web:** Apache, Nginx, atau sejenisnya.
-   **PHP:** Versi 7.x atau lebih tinggi disarankan.
-   **Database:** MySQL atau MariaDB.

## 🛠️ Setup Awal / Instalasi

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek ini di lingkungan lokal Anda:

1.  **Clone Repositori:**
    ```bash
    git clone <URL_REPOSITORI_ANDA>
    cd sistem_gudang
    ```

2.  **Konfigurasi Database:**
    *   Buat database baru (misalnya `gudang_db`) di MySQL/MariaDB Anda.
    *   Jalankan query SQL berikut untuk membuat tabel yang diperlukan:

        ```sql
        -- Tabel users
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('operator', 'user') NOT NULL,
            gudang_id INT NULL, -- Untuk pengguna yang menyewa gudang
            FOREIGN KEY (gudang_id) REFERENCES gudang(id) ON DELETE SET NULL
        );

        -- Tabel gudang
        CREATE TABLE gudang (
            id INT AUTO_INCREMENT PRIMARY KEY,
            lokasi VARCHAR(255) NOT NULL,
            penyewa VARCHAR(255) NULL,
            tanggal_sewa DATE NULL,
            tanggal_akhir_sewa DATE NULL,
            gambar VARCHAR(255) NULL -- Path gambar gudang
        );

        -- Tabel barang
        CREATE TABLE barang (
            id INT AUTO_INCREMENT PRIMARY KEY,
            gudang_id INT NOT NULL,
            nama_barang VARCHAR(255) NOT NULL,
            jumlah INT NOT NULL,
            FOREIGN KEY (gudang_id) REFERENCES gudang(id) ON DELETE CASCADE
        );
        ```

    *   Sesuaikan kredensial database di `db_connection.php`:
        ```php
        <?php
        $servername = "localhost";
        $username = "operator"; // Ganti dengan username database Anda
        $password = "password123"; // Ganti dengan password database Anda
        $dbname = "gudang_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi ke database gagal: " . $conn->connect_error);
        }
        ?>
        ```

3.  **Tambahkan Pengguna Awal (Opsional, melalui `Draft/add_user.php`):**
    *   Untuk menambahkan pengguna awal (misalnya operator), Anda bisa mengakses `Draft/add_user.php` secara langsung di browser Anda setelah menempatkan file di server web. Contoh:
        `http://localhost/sistem_gudang/Draft/add_user.php`
    *   Isi formulir untuk membuat pengguna dengan peran `operator` atau `user`.

4.  **Jalankan Aplikasi:**
    *   Tempatkan folder `sistem_gudang` di direktori root web server Anda (misalnya, `htdocs` untuk XAMPP, `www` untuk WAMP).
    *   Buka browser Anda dan navigasikan ke `http://localhost/sistem_gudang`.

## 💡 Potensi Pengembangan Lebih Lanjut

-   **Antarmuka Pengguna yang Lebih Modern:** Tingkatkan desain UI/UX dengan framework CSS (misalnya Bootstrap, Tailwind CSS) dan JavaScript untuk pengalaman yang lebih interaktif.
-   **Manajemen Pengguna yang Lebih Robust:** Implementasikan fitur registrasi pengguna, reset password, dan manajemen peran yang lebih canggih (misalnya, peran `admin` untuk mengelola semua pengguna).
-   **Pencarian dan Filter:** Tambahkan fungsionalitas pencarian dan filter untuk gudang dan barang.
-   **Laporan dan Analisis:** Buat laporan mengenai penggunaan gudang, inventaris barang, atau riwayat transaksi.
-   **Notifikasi:** Sistem notifikasi untuk operator (misalnya, gudang akan habis masa sewanya) atau pengguna (misalnya, barang baru ditambahkan).
-   **Upload Gambar:** Implementasikan fitur upload gambar untuk gudang secara langsung melalui antarmuka.
-   **Keamanan:** Perkuat keamanan aplikasi dengan validasi input yang lebih ketat, perlindungan CSRF, dan praktik keamanan web lainnya.
-   **API:** Kembangkan API untuk memungkinkan integrasi dengan sistem lain.