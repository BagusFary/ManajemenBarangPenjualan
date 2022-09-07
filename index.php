<?php
require "functions.php";

$produk = query("SELECT * FROM produk");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang Penjualan</title>
</head>
<body>

    

    <h1>List Barang</h1>

    <a href="tambah.php">Tambah Barang Penjualan</a>

    <br><br>

    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kode Barang</th>
            <th>Harga</th>
            <th>Kategori</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($produk as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"];?>">Ubah</a>
                <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('yakin?')">Hapus</a>
            </td>
            <td><img src="img/<?= $row["gambar"];?>" width="100"></td>
            <td><?= $row["nama"];?></td>
            <td><?= $row["kode_barang"];?></td>
            <td><?= $row["harga"];?></td>
            <td><?= $row["kategori"];?></td>        
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        
    </table>
    
</body>
</html>