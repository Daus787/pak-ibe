<?php
include '../config/koneksi.php';

$penjualanID = $_POST['penjualanID'];
$produkID    = $_POST['produkID'];
$jumlah      = $_POST['jumlah'];

mysqli_begin_transaction($koneksi);

try {

  // cek harga + stok produk
  $qProduk = mysqli_query($koneksi, "SELECT harga, stok FROM produk WHERE id_produk = '$produkID'");
  $produk = mysqli_fetch_assoc($qProduk);

  if ($jumlah > $produk['stok']) {
    throw new Exception("stok_tidak_cukup");
  }

  $harga = $produk['harga'];
  $subtotal = $harga * $jumlah;

  // insert ke detailpenjualan
  $insertDetail = mysqli_query($koneksi, "
    INSERT INTO detailpenjualan (penjualanID, ProdukID, JumlahProduk, Subtotal)
    VALUES ('$penjualanID', '$produkID', '$jumlah', '$subtotal')  
  ");

  if (!$insertDetail) {
    throw new Exception("insert_gagal");
  }

  // jika semua berhasil, eksekusi ke database
  mysqli_commit($koneksi);
  header("location: detail.php?penjualanID=$penjualanID&success=tambah_detail");
} catch (Exception $e) {

  // membatalkan semua query yang sudah dijalankan
  mysqli_rollback($koneksi);

  // menampilkan pesan error
  echo $e->getMessage();
}
