<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {

  $id          = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $harga       = $_POST['harga'];
  $stok        = $_POST['stok'];

  $query = "UPDATE produk SET
                nama_produk = '$nama_produk',
                harga       = '$harga',
                stok        = '$stok'
              WHERE id_produk = '$id'";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    header("Location: index_produk.php?status_edit=sukses&nama=$nama_produk");
  } else {
    header("Location: index_produk.php?status_edit=gagal&nama=$nama_produk");
  }
  exit;
} else {
  die("Akses dilarang...");
}
