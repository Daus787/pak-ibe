<?php
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $pelangganID = $_POST['pelangganID'];

    $query = "INSERT INTO transaksi (tanggalpenjualan, pelangganID) VALUES ('$tanggal', '$pelangganID')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index_trans.php?pesan=berhasil");
    } else {
        header("Location: index_trans.php?pesan=gagal");
    }
}
?>