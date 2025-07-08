<?php
$host = 'localhost'; 
$username = 'admin'; 
$password = 'SOK1PSTIC'; 
$database = 'haji_tabungan';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
