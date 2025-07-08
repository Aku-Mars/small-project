<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Haji</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        h2 {
            padding-top: 30px;
        }
        
        h3 {
            padding-top: 30px;
            text-align: justify;
        }

        .container {
            max-width: 850px;
            margin: 20px auto;
            padding: 15px 50px;
            flex-wrap: wrap;
            justify-content: space-between;
            text-align: justify;
            border-radius: 20px;
            background: #f7f7f7;
            box-shadow: 5px 5px 30px #666,
                    -5px -5px 30px #cfcfcf;
        }

        .container h2 {
            text-align: center;
            margin-top: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .hapus-btn {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .hapus-btn:hover {
            background-color: #d32f2f;
        }

        #hitungBtn {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 50%; 
        text-align: center;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    #hitungBtn:hover {
        background-color: #45a049;
    }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f4f4f4;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 9999;
        }
        
        .popup .close {
        font-size: 24px;
        color: red;
        cursor: pointer;
        height: 5px;
        width: 5px;
        }


        label {
            margin-top: 10px;
            display: block; 
        }

        input[type="text"] {
            margin-bottom: 10px; 
            width: 100%; 
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <header>
        <h1>Kalkulator Haji</h1>
    </header>

    <div class="container">
        <h3>Ini Merupakan Kalkulator Sederhana Yang Dapat Menghitung Berapa lama Anda Harus Menabung Dari Jumlah Anda Menabung Perbulannya Hingga Biaya Hajinya Tercukupi</h3>
        <form id="hajiForm" action="hitung.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama">
            <label for="harga_haji">Biaya Haji:</label>
            <input type="text" id="harga_haji" name="harga_haji">
            <label for="tabungan_perbulan">Tabungan per Bulan:</label>
            <input type="text" id="tabungan_perbulan" name="tabungan_perbulan">
            <input type="submit" id="hitungBtn" value="Hitung">
        </form>

        <div id="popup" class="popup">
            <span class="close" onclick="closePopup()">&times;</span>
            <p id="popupContent"></p>
        </div>

        <h2>Data yang Tersimpan</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>Biaya Haji</th>
                <th>Tabungan per Bulan</th>
                <th>Lama Menabung</th>
                <th>Aksi</th>
            </tr>
            <?php
            include 'koneksi.php';

            $sql = "SELECT * FROM haji";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['harga_haji'] . "</td>";
                echo "<td>" . $row['tabungan_perbulan'] . "</td>";
                echo "<td>" . $row['lama_menabung'] . " bulan</td>";
                echo "<td><button class='hapus-btn' onclick='hapusData(" . $row['id'] . ")'>Hapus</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data tersimpan.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </div>

    <script>
        function hapusData(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                $.ajax({
                    type: 'POST',
                    url: 'hapus.php',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        }

        $(document).ready(function(){
            $('#hajiForm').submit(function(e){
                e.preventDefault();
                var hargaHaji = $('#harga_haji').val();
                var tabunganPerbulan = $('#tabungan_perbulan').val();
                var lamaMenabung = Math.ceil(hargaHaji / tabunganPerbulan);
                $('#lama_menabung').val(lamaMenabung);

                $.ajax({
                    type: 'POST',
                    url: 'hitung.php',
                    data: $('#hajiForm').serialize(),
                    success: function(response) {
                        $('#popupContent').html(response);
                        $('#popup').show();
                        $('.popup .close').css({'font-size': '24px', 'color': 'red', 'cursor': 'pointer'});
                    }
                });
            });
        });

        function closePopup() {
            $('#popup').hide();
            location.reload();
        }
    </script>
</body>
</html>