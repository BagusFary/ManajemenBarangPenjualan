<?php
$conn = mysqli_connect("localhost", "root", "", "manajemenbarang");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;
    

}

function tambah($data) {
    global $conn;

    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO produk 
                VALUES ('','$kode_barang', '$nama', '$kategori', '$harga', '$gambar')";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar')
                </script>";
                return false;
    }

    if( $ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar')
                </script>";
                return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
    
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $kode_barang = htmlspecialchars($data["kode_barang"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE produk SET
                kode_barang = '$kode_barang',
                nama = '$nama',
                kategori = '$kategori',
                harga = '$harga',
                gambar = '$gambar'
                WHERE id = $id
                ";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
}




?>