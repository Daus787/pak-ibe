<?php
// 1. Panggil koneksi database
include '../config/koneksi.php';

// 2. Cek apakah parameter penjualanID ada
if (isset($_GET['penjualanID'])) {

  // 3. Tangkap ID transaksi dari URL
  $penjualanID = $_GET['penjualanID'];
  $nama = $_GET['nama'] ?? '';

  // 4. Query hapus data transaksi
  $query = mysqli_query(
    $koneksi,
    "DELETE FROM penjualan WHERE penjualanID = '$penjualanID'"
  );

  // 5. Cek hasil query
  if ($query) {
    header("Location: index_trans.php?status_hapus=sukses&nama=" . urlencode($nama));
  } else {
    header("Location: index_trans.php?status_hapus=gagal&nama=" . urlencode($nama));
  }
} else {
  die("Akses dilarang...");
}
