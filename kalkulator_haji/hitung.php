<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$harga_haji = $_POST['harga_haji'];
$tabungan_perbulan = $_POST['tabungan_perbulan'];

// Menghitung lama menabung
$lama_menabung = ceil($harga_haji / $tabungan_perbulan);

$total_tabungan = $tabungan_perbulan * $lama_menabung;
$kekurangan = $harga_haji - $total_tabungan;

echo "Nama: $nama <br>";
echo "Harga Haji: $harga_haji <br>";
echo "Tabungan per Bulan: $tabungan_perbulan <br>";
echo "Lama Menabung: $lama_menabung bulan <br><br>";

// Simpan data ke database
$sql = "INSERT INTO haji (nama, harga_haji, tabungan_perbulan, lama_menabung) VALUES ('$nama', '$harga_haji', '$tabungan_perbulan', '$lama_menabung')";
if ($conn->query($sql) === TRUE) {
    echo "<br>Data berhasil disimpan ke database.";
} else {
    echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
