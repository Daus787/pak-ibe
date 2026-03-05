<?php
include "../config/koneksi.php";

if (isset($_GET['id']) && isset($_GET['nama'])) {

  $id   = $_GET['id'];
  $nama = $_GET['nama'];

  $sql   = "DELETE FROM produk WHERE id_produk = '$id'";
  $query = mysqli_query($koneksi, $sql);

  if ($query) {
    header("Location: index_produk.php?status_hapus=sukses&nama=$nama");
  } else {
    header("Location: index_produk.php?status_hapus=gagal&nama=$nama");
  }
  exit;
} else {
  die("Akses dilarang...");
}
