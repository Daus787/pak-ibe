<?php
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {
  $tanggalPenjualan = $_POST['tanggal'];
  $pelangganID = $_POST['pelangganID'];

  // Add terbukti, terbukti untuk transaksi yang sama
  $result = mysqli_query($koneksi, "
        SELECT penjualanID
        FROM penjualan
        WHERE tanggalPenjualan = '$tanggalPenjualan'
        AND pelangganID = '$pelangganID'
        LIMIT 1
    ");

  if (!$result) {
    die("query error: " . mysqli_error($koneksi));
  }

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    // akan digunakan untuk insert detail transaksi
    header("Location: index_trans.php?pesan=ditambahkan...");
  } else {
    // Data belum ada transaksi di tanggal tersebut
    // Cek berapa jumlah transaksi di tanggal yang sama

    $resultCount = mysqli_query($koneksi, "
      SELECT COUNT(*) as jumlah FROM penjualan 
      WHERE DATE(tanggalPenjualan) = '$tanggalPenjualan'
    ");

    $rowCount = mysqli_fetch_assoc($resultCount);
    $noPenjualan = $rowCount['jumlah'] + 1;

    // Format jadi 4 digit (0001, 0002, dst)
    $noPenjualan = str_pad($noPenjualan, 4, '0', STR_PAD_LEFT);

    // Format tanggal untuk ID (DDMMYYYY)
    $tanggalID = date("dmy", strtotime($tanggalPenjualan));

    // Gabungkan
    $noPenjualanID = $tanggalID . $noPenjualan;

    // Insert data
    $query = mysqli_query($koneksi, "
      INSERT INTO penjualan (penjualanID, tanggalPenjualan, pelangganID, TotalHarga)
      VALUES ('$noPenjualanID', '$tanggalPenjualan', '$pelangganID', 0)
    ");

    if ($query) {
      header("Location: index_trans.php?pesan=berhasil");
    } else {
      die("Insert gagal: " . mysqli_error($koneksi));
    }
  }
}
