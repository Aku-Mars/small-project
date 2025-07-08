<?php
session_set_cookie_params(604800); 
session_start();

function isUserAuthenticated() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function tambahTamu($nama) {
    $tamu = array(
        'nama' => $nama,
        'tanggal_masuk' => date('Y-m-d H:i:s'),
        'tanggal_keluar' => null
    );
    $_SESSION['daftar_tamu'][] = $tamu;
}

function tandaiKeluar($index) {
    $_SESSION['daftar_tamu'][$index]['tanggal_keluar'] = date('Y-m-d H:i:s');
}

function hapusTamu($index) {
    unset($_SESSION['daftar_tamu'][$index]);
}

if (!isset($_SESSION['daftar_tamu'])) {
    $_SESSION['daftar_tamu'] = array();
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Redirect jika belum login
if (!isUserAuthenticated() && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header("Location: login.php");
    exit;
}

// Proses form tamu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_masuk'])) {
        $nama = $_POST['nama'];
        tambahTamu($nama);
    } elseif (isset($_POST['submit_keluar'])) {
        $index = $_POST['index'];
        tandaiKeluar($index);
    } elseif (isset($_POST['submit_hapus'])) {
        $index = $_POST['index'];
        hapusTamu($index);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hadir Tamu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-size: 32px;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            left: 30px;
        }
        .form-add-guest {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
            text-align: left;
        }
        .form-add-guest label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-add-guest input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .tombol {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-right: 5px;
        }
        .tombol:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }
        .tombol:active {
            transform: translateY(0);
        }
        .tombol.keluar {
            background-color: #28a745;
        }
        .tombol.keluar:hover {
            background-color: #218838;
        }
        .tombol.hapus {
            background-color: #dc3545;
        }
        .tombol.hapus:hover {
            background-color: #c82333;
        }
        .tabel {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        .tabel th,
        .tabel td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
        }
        .tabel th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }
        .tabel tbody tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        .tabel tbody tr:hover {
            background-color: #f1f1f1;
        }
        .tabel td form {
            display: inline-block;
            margin: 0;
        }
        .tabel td form input[type="submit"] {
            padding: 8px 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Tamu</h2>

    <!-- Tombol Logout -->
    <form method="post" class="logout-btn">
        <input type="submit" name="logout" value="Logout" class="tombol">
    </form>

    <!-- Form untuk tambah tamu -->
    <form method="post" class="form-add-guest">
        <label for="nama">Nama Tamu:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        <input type="submit" name="submit_masuk" value="Masuk" class="tombol">
    </form>

    <!-- Tabel daftar tamu -->
    <table class="tabel">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Tamu</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['daftar_tamu'] as $index => $tamu): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $tamu['nama']; ?></td>
                    <td><?php echo $tamu['tanggal_masuk']; ?></td>
                    <td><?php echo $tamu['tanggal_keluar'] ?? 'Belum keluar'; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <?php if (!$tamu['tanggal_keluar']): ?>
                                <input type="submit" name="submit_keluar" value="Keluar" class="tombol keluar">
                            <?php endif; ?>
                            <input type="submit" name="submit_hapus" value="Hapus" class="tombol hapus">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
