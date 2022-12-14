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


if( isset($_GET["filterharga"]) ) {

    $minimal = $_GET["minimal"];
    $maksimal = $_GET["maksimal"];
     
    $outputProduk = query("SELECT * FROM produk WHERE harga BETWEEN $minimal AND $maksimal");



    
    
} else {

    

    $outputProduk = query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman");


}




$produk = $outputProduk

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang Penjualan</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 130px;
            z-index: -1;
            left: 300px;
            display: none;
        }
    </style>
</head>
<body>

<a href="logout.php">Logout</a>    

    <h1>List Barang</h1>

    <a href="tambah.php">Tambah Barang Penjualan</a>
    <br> <br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

        <img src="img/loader.gif" class="loader">

    </form>
    <br>

    <form action="" method="get">

        <ul>
            <li>
                <label for="minimal">Harga Minimal : </label>
                <input type="number" name="minimal" id="minimal">
            </li>
            <li>
                <label for="maksimal">Harga Maksimal : </label>
                <input type="number" name="maksimal" id="maksimal">
            </li>
            <li>
                <button type="submit" name="filterharga">Filter</button>
            </li>
        </ul>
    </form>

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
    <div id="container">
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
    </div>

    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/script.js"></script>
    
</body>
</html>