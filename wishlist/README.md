# 🎁 Simple Wishlist - Catat Keinginanmu dengan Mudah!

![Wishlist](https://raw.githubusercontent.com/Aku-Mars/gambar/main/bannercps.png)

## Deskripsi Aplikasi

Simple Wishlist adalah aplikasi web sederhana yang memungkinkan Anda untuk membuat dan mengelola daftar keinginan atau tugas. Dibangun dengan PHP dan MariaDB, aplikasi ini menyediakan fungsionalitas dasar untuk menambah, menandai selesai, dan menghapus item. Dilengkapi juga dengan fitur mode gelap untuk kenyamanan visual Anda.

## ✨ Fitur Utama

-   **Tambah Item:** Masukkan item baru ke dalam daftar keinginan Anda.
-   **Tandai Selesai:** Tandai item sebagai selesai atau belum selesai.
-   **Hapus Item:** Hapus item yang tidak lagi diperlukan dari daftar.
-   **Mode Gelap:** Beralih antara tema terang dan gelap untuk pengalaman pengguna yang lebih baik.

## 🚀 Teknologi yang Digunakan

-   **PHP:** Sebagai bahasa pemrograman sisi server untuk logika aplikasi dan interaksi database.
-   **MariaDB:** Sebagai sistem manajemen database untuk menyimpan daftar keinginan.
-   **HTML:** Untuk struktur halaman web.
-   **CSS:** Untuk styling antarmuka pengguna.
-   **JavaScript:** Untuk fungsionalitas interaktif seperti mode gelap dan toggle tombol hapus.

## 📋 Syarat (Prasyarat)

Untuk menjalankan aplikasi ini, Anda memerlukan lingkungan server web yang mendukung PHP dan database MariaDB/MySQL. Contohnya:

-   **Server Web:** Apache, Nginx, atau PHP built-in server.
-   **PHP:** Versi 7.x atau lebih tinggi disarankan.
-   **Database:** MariaDB atau MySQL.

## 🛠️ Setup Awal / Instalasi

Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek ini di lingkungan lokal Anda:

1.  **Clone Repositori:**
    ```bash
    git clone <URL_REPOSITORI_ANDA>
    cd wishlist
    ```

2.  **Konfigurasi Database:**
    *   Buat database baru (misalnya `wishlist_db`) di MariaDB/MySQL Anda.
    *   Jalankan query SQL berikut untuk membuat tabel `wishlist`:
        ```sql
        CREATE DATABASE wishlist_db;
        USE wishlist_db;
        CREATE TABLE wishlist (
            id INT AUTO_INCREMENT PRIMARY KEY,
            item VARCHAR(255) NOT NULL,
            completed BOOLEAN DEFAULT FALSE
        );
        ```
    *   Sesuaikan kredensial database di `db.php`:
        ```php
        <?php
        $servername = "localhost";
        $username = ""; // Ganti dengan username database Anda
        $password = ""; // Ganti dengan password database Anda
        $dbname = "wishlist_db";
        ```

3.  **Jalankan Aplikasi:**
    *   Tempatkan folder `wishlist` di direktori root web server Anda (misalnya, `htdocs` untuk XAMPP, `www` untuk WAMP).
    *   Atau, Anda bisa menggunakan PHP built-in server dari direktori proyek:
        ```bash
        php -S localhost:8000
        ```
    *   Kemudian, buka browser Anda dan navigasikan ke `http://localhost:8000` (atau sesuai dengan konfigurasi server web Anda).

## 💡 Potensi Pengembangan Lebih Lanjut

-   **Edit Item:** Tambahkan fungsionalitas untuk mengedit teks item yang sudah ada.
-   **Filter & Pencarian:** Implementasikan fitur untuk memfilter item (misalnya, hanya menampilkan yang belum selesai) atau mencari item tertentu.
-   **Autentikasi Pengguna:** Tambahkan sistem login/registrasi untuk memungkinkan setiap pengguna memiliki daftar keinginan pribadi.
-   **Kategori & Prioritas:** Fitur untuk mengkategorikan item atau menetapkan tingkat prioritas.
-   **Tanggal Tenggat Waktu:** Tambahkan opsi untuk menetapkan tanggal tenggat waktu pada item.
-   **Notifikasi:** Integrasikan notifikasi (misalnya, email atau notifikasi browser) untuk pengingat item.
-   **UI/UX yang Lebih Kaya:** Tingkatkan tampilan dan pengalaman pengguna dengan framework CSS modern dan animasi.
-   **API:** Kembangkan API untuk memungkinkan integrasi dengan aplikasi lain (misalnya, aplikasi seluler).
