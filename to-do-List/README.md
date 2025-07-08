# ✅ To-Do List App - Kelola Tugasmu dengan Mudah!

![To-Do List Screenshot](image.png)

## Deskripsi Aplikasi

Aplikasi To-Do List ini hadir dalam dua versi: **Offline** (berbasis HTML/JavaScript murni) dan **Online** (berbasis Flask dengan database MariaDB). Keduanya dirancang untuk membantu Anda mengelola daftar tugas atau kegiatan sehari-hari dengan efisien. Baik Anda membutuhkan solusi cepat tanpa instalasi server, atau sistem yang lebih robust dengan penyimpanan data terpusat, aplikasi ini siap membantu Anda tetap terorganisir.

## ✨ Fitur Utama

### Fitur Umum (Tersedia di Kedua Versi)

-   **Penambahan Tugas:** Tambahkan tugas baru dengan judul dan tanggal tenggat waktu.
-   **Pengeditan Tugas:** Ubah detail tugas yang sudah ada.
-   **Penghapusan Tugas:** Hapus tugas yang sudah selesai atau tidak diperlukan.
-   **Tema Gelap/Terang:** Pilih tampilan tema sesuai preferensi Anda.
-   **Tampilan Responsif:** Antarmuka yang menyesuaikan dengan berbagai ukuran layar (desktop, tablet, mobile).

### Fitur Spesifik Versi Online (Flask + MariaDB)

-   **Penyimpanan Data Persisten:** Tugas disimpan dalam database MariaDB, memastikan data aman dan dapat diakses dari mana saja.
-   **Riwayat Tugas:** Tugas yang dihapus akan dipindahkan ke riwayat, memungkinkan Anda untuk melihat kembali atau mengembalikan tugas tersebut.
-   **Pengurutan Tugas:** Tugas diurutkan berdasarkan tanggal tenggat waktu untuk prioritas yang jelas.
-   **Penghitung Tugas:** Menampilkan jumlah total tugas yang aktif.
-   **Deskripsi Tugas:** Tambahkan deskripsi atau informasi tambahan untuk setiap tugas.

## 🚀 Teknologi yang Digunakan

### Versi Offline

-   **HTML:** Struktur dasar halaman web.
-   **CSS:** Styling antarmuka pengguna.
-   **JavaScript:** Logika aplikasi, manajemen tugas, dan penyimpanan data di Local Storage.

### Versi Online

-   **Python:** Bahasa pemrograman utama.
-   **Flask:** Micro-framework web untuk membangun aplikasi.
-   **Flask-SQLAlchemy:** Ekstensi Flask untuk interaksi dengan database.
-   **MariaDB:** Sistem manajemen database relasional.
-   **HTML, CSS, JavaScript:** Untuk antarmuka pengguna.

## 📋 Syarat (Prasyarat)

### Versi Offline

-   **Browser Web Modern:** Cukup browser web modern yang mendukung HTML5, CSS3, dan JavaScript (misalnya Chrome, Firefox, Edge).

### Versi Online

-   **Python 3.x:** Lingkungan runtime Python.
-   **pip:** Manajer paket Python.
-   **MariaDB/MySQL Server:** Server database yang berjalan.
-   **Web Server (Opsional):** Apache atau Nginx jika ingin deploy ke lingkungan produksi.

## 🛠️ Setup Awal / Instalasi

### Versi Offline

1.  **Clone Repositori:**
    ```bash
    git clone <URL_REPOSITORI_ANDA>
    cd to-do-List/Offline
    ```
2.  **Buka File `index.html`:**
    *   Cukup buka file `index.html` di browser web Anda. Anda bisa melakukannya dengan mengklik dua kali file tersebut atau menyeretnya ke jendela browser.

### Versi Online

1.  **Clone Repositori:**
    ```bash
    git clone <URL_REPOSITORI_ANDA>
    cd to-do-List/Online
    ```

2.  **Konfigurasi Database MariaDB:**
    *   Akses shell MariaDB/MySQL Anda:
        ```bash
        sudo mariadb
        ```
    *   Buat database dan tabel:
        ```sql
        CREATE DATABASE todo_list;
        USE todo_list;
        CREATE TABLE tasks (
             id INT AUTO_INCREMENT PRIMARY KEY,
             title VARCHAR(255) NOT NULL,
             due_date DATE,
             description TEXT,
             is_completed BOOLEAN DEFAULT FALSE
        );
        CREATE TABLE deleted_task (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            due_date DATE,
            deleted_at DATETIME
        );
        ```
    *   Buat user database dan berikan hak akses (ganti `new_user` dan `password`):
        ```sql
        CREATE USER 'new_user'@'localhost' IDENTIFIED BY 'password';
        GRANT ALL PRIVILEGES ON todo_list.* TO 'new_user'@'localhost';
        FLUSH PRIVILEGES;
        exit;
        ```

3.  **Sesuaikan Koneksi Database:**
    *   Buka file `app.py` dan ubah baris `app.config['SQLALCHEMY_DATABASE_URI']` sesuai dengan kredensial database Anda:
        ```python
        app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://new_user:password@localhost/todo_list'
        ```

4.  **Instal Dependensi Python:**
    ```bash
    pip install Flask Flask-SQLAlchemy pytz
    ```

5.  **Jalankan Aplikasi Flask:**
    ```bash
    python3 app.py
    ```
    *   Aplikasi akan berjalan di `http://localhost:3000` secara default.
    *   Untuk menjalankan di latar belakang (Linux/macOS):
        Tekan `Ctrl + Z` lalu ketik `bg` dan `Enter`.

## 💡 Potensi Pengembangan Lebih Lanjut

-   **Sistem Autentikasi Pengguna:** Implementasikan fitur login/registrasi untuk setiap pengguna agar memiliki daftar tugas pribadi.
-   **Tampilan Kalender:** Integrasikan tampilan kalender untuk visualisasi tugas berdasarkan tanggal.
-   **Kategori/Tag Tugas:** Tambahkan kemampuan untuk mengkategorikan atau memberi tag pada tugas.
-   **Prioritas Tugas:** Fitur untuk menetapkan tingkat prioritas pada tugas.
-   **Notifikasi/Pengingat:** Kirim notifikasi (misalnya email atau notifikasi browser) untuk tugas yang akan datang.
-   **Integrasi API:** Jika memungkinkan, integrasikan dengan layanan kalender atau aplikasi lain.
-   **Pencarian dan Filter:** Fungsionalitas pencarian dan filter yang lebih canggih untuk tugas.
-   **Fitur Kolaborasi:** Memungkinkan berbagi daftar tugas dengan pengguna lain.
-   **PWA (Progressive Web App):** Jadikan aplikasi dapat diinstal dan berjalan secara offline (untuk versi online).