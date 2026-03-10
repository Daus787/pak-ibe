<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
  $penjualanID = $_POST['penjualanID'];
  $produkID = $_POST['produkID'];
  $jumlah = $_POST['jumlah'];

  // Cek stok produk
  $query_stok = mysqli_query($koneksi, "SELECT harga, stok FROM produk WHERE id_produk = '$produkID'");
  $produk = mysqli_fetch_assoc($query_stok);

  if ($produk['stok'] < $jumlah) {
    // Stok tidak cukup
    header("Location: form_tambah_detail.php?id=$penjualanID&error=stok_tidak_cukup");
    exit;
  }

  $harga = $produk['harga'];
  $subtotal = $harga * $jumlah;

  // Kurangi stok
  $stok_baru = $produk['stok'] - $jumlah;
  mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$produkID'");

  // Insert ke detailpenjualan
  $query_insert = mysqli_query($koneksi, "
        INSERT INTO detailpenjualan (penjualanID, ProdukID, JumlahProduk, Subtotal)
        VALUES ('$penjualanID', '$produkID', '$jumlah', '$subtotal')
    ");

  if ($query_insert) {
    // Update total harga di penjualan
    $query_total = mysqli_query($koneksi, "
            SELECT SUM(Subtotal) as total FROM detailpenjualan WHERE penjualanID = '$penjualanID'
        ");
    $total_data = mysqli_fetch_assoc($query_total);
    $total_harga = $total_data['total'];

    mysqli_query($koneksi, "UPDATE penjualan SET TotalHarga = '$total_harga' WHERE penjualanID = '$penjualanID'");

    header("Location: detail.php?penjualanID=$penjualanID&success=tambah_detail");
  } else {
    header("Location: form_tambah_detail.php?id=$penjualanID&error=insert_gagal");
  }
} else {
  die("Akses dilarang...");
}
