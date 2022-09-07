<?php
require "functions.php";

if(isset($_POST["submit"]) ) {


    if(tambah($_POST) > 0 ) {
        echo "
            <script>
            alert('Barang Berhasil Ditambahkan');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Barang Gagal Ditambahkan');
            document.location.href = 'index.php';
            </script>
            ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Penjualan</title>
</head>
<body>
    <h1>Tambah Barang Penjualan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama Barang : </label>
                <input type="text" id="nama" name="nama" required autofocus>
            </li>
            <li>
                <label for="kode_barang">Kode Barang : </label>
                <input type="text" id="kode_barang" name="kode_barang" required>
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" id="harga" name="harga" required>
            </li>
            <li>
                <label for="kategori">Kategori : </label>
                <input type="text" id="kategori" name="kategori" required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" for="gambar" name="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Barang</button>
            </li>
        </ul>
    </form>
    
</body>
</html>