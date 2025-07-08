<?php
include 'koneksi.php';

// Menerima ID yang dikirimkan melalui AJAX
$id = $_POST['id'];

// Hapus data dari database berdasarkan ID
$sql = "DELETE FROM haji WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
