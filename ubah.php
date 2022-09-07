<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require "functions.php";

$id = $_GET["id"];

$barang = query("SELECT * FROM produk WHERE id = $id")[0];

if( isset($_POST["submit"]) ) {

    if (ubah($_POST) > 0 ) {
        echo"<script>
                alert('Barang Berhasil diubah');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo"<script>
                alert('Barang Gagal Diubah')
                document.location.href = 'index.php';
                </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang Penjualan</title>
    <style>
        label {
                display: block;  
        }
    </style>
</head>
<body>
    <h1>Ubah Barang Penjualan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $barang["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $barang["gambar"];?>">
        <ul>
            <li>
                <label for="kode_barang">Kode Barang : </label>
                <input type="text" name="kode_barang" id="kode_barang" required value="<?= $barang["kode_barang"];?>">
            </li>
            <li>
                <label for="nama">Nama Barang : </label>
                <input type="text" name="nama" id="nama" value="<?= $barang["nama"];?>">
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" name="harga" id="harga" value="<?= $barang["harga"];?>">
            </li>
            <li>
                <label for="kategori">Kategori : </label>
                <input type="text" name="kategori" id="kategori" value="<?= $barang["kategori"];?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <img src="img/<?= $barang["gambar"];?>" width="200">
                <input type="file" name="gambar" id="gambar" value="<?= $barang["gambar"];?>">
            </li>
            <li>
                <button type="submit" name="submit" onclick="return confirm('yakin?')">Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>