<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
  $detailID = $_GET['id'];
  $penjualanID = $_GET['penjualanID'];

  // Ambil data detail untuk kembalikan stok
  $query_detail = mysqli_query($koneksi, "
        SELECT ProdukID, JumlahProduk FROM detailpenjualan WHERE DetailID = '$detailID'
    ");
  $detail = mysqli_fetch_assoc($query_detail);

  if ($detail) {
    // Kembalikan stok
    mysqli_query($koneksi, "
            UPDATE produk SET stok = stok + {$detail['JumlahProduk']} WHERE id_produk = '{$detail['ProdukID']}'
        ");

    // Hapus detail
    mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE DetailID = '$detailID'");

    // Update total harga
    $query_total = mysqli_query($koneksi, "
            SELECT SUM(Subtotal) as total FROM detailpenjualan WHERE penjualanID = '$penjualanID'
        ");
    $total_data = mysqli_fetch_assoc($query_total);
    $total_harga = $total_data['total'] ?? 0;

    mysqli_query($koneksi, "UPDATE penjualan SET TotalHarga = '$total_harga' WHERE penjualanID = '$penjualanID'");

    header("Location: detail.php?penjualanID=$penjualanID&success=hapus_detail");
  } else {
    header("Location: detail.php?penjualanID=$penjualanID&error=detail_tidak_ditemukan");
  }
} else {
  die("Akses dilarang...");
}
