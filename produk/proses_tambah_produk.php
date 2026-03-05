<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {

  $nama_produk = $_POST['nama_produk'];

  // Bersihkan harga dari Rp dan titik
  $harga = $_POST['harga'];
  // $harga = str_replace(['Rp', '.', ' '], '', $harga);

  $stok  = $_POST['stok'];

  $sql = "INSERT INTO produk (nama_produk, harga, stok)
            VALUES ('$nama_produk', '$harga', '$stok')";

  $query = mysqli_query($koneksi, $sql);

  if ($query) {
    header("Location: index_produk.php?status_tambah=sukses&nama=$nama_produk");
  } else {
    header("Location: index_produk.php?status_tambah=gagal&nama=$nama_produk");
  }
  exit;
}
