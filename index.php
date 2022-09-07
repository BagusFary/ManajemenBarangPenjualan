<?php
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require "functions.php";


$jumlahDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM produk"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$produk = query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman");

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

<a href="logout.php">Logout</a>    

    <h1>List Barang</h1>

    <a href="tambah.php">Tambah Barang Penjualan</a>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">Cari!</button>
    </form>
    <br>

   <!-- navigasi -->

   <?php if($halamanAktif > 1) : ?>
    <a href="?halaman=<?php echo $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
        <?php if( $i == $halamanAktif ) : ?>
        <a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if($halamanAktif < $jumlahHalaman) : ?>
    <a href="?halaman=<?php echo $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
    <br>


    <br>

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
        <?php foreach( $produk as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> |
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