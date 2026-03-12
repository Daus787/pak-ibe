<?php
include '../config/koneksi.php';

if (!isset($_GET['penjualanID'])) {
  die("Akses dilarang...");
}

$id = $_GET['penjualanID'];

// =========================
// Ambil data transaksi + pelanggan
// =========================

$query_transaksi = mysqli_query($koneksi, "
    SELECT penjualan.*, pelanggan.Namapelanggan
    FROM penjualan
    LEFT JOIN pelanggan 
    ON penjualan.pelangganID = pelanggan.pelangganID
    WHERE penjualan.penjualanID = '$id'
");

$transaksi = mysqli_fetch_assoc($query_transaksi);


// =========================
// Ambil detail barang
// =========================

$query_detail = mysqli_query($koneksi, "
    SELECT detailpenjualan.*, produk.nama_produk, produk.harga
    FROM detailpenjualan
    JOIN produk 
    ON detailpenjualan.ProdukID = produk.id_produk
    WHERE detailpenjualan.penjualanID = '$id'
");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Nota</title>

  <style>
    body {
      font-family: monospace;
    }

    .nota {
      width: 300px;
      margin: auto;
    }

    .center {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 3px;
    }

    hr {
      border: 1px dashed black;
    }

    @media print {

      .btn-print {
        display: none;
      }

    }
  </style>

</head>

<body>

  <div class="nota">

    <div class="center">
      <h3>TOKO SMKN 7 Makassar</h3>
      Jl. Ince Nurdin<br>
      ====================
    </div>

    <table>
      <tr>
        <td>No Transaksi</td>
        <td>: <?php echo $transaksi['penjualanID']; ?></td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>: <?php echo date('d F Y', strtotime($transaksi['TanggalPenjualan'])); ?></td>
      </tr>
      <tr>
        <td>Pelanggan</td>
        <td>: <?php echo $transaksi['Namapelanggan']; ?></td>
      </tr>
    </table>

    <hr>

    <table>

      <thead>
        <th>Barang</th>
        <th align="right">Qty</th>
        <th align="right">Harga</th>
        <th align="right">Sub</th>
      </thead>

      <?php

      $total = 0;

      while ($data = mysqli_fetch_assoc($query_detail)) {

        $subtotal = $data['JumlahProduk'] * $data['harga'];
        $total += $subtotal;

      ?>

        <tr>
          <td><?php echo $data['nama_produk']; ?></td>
          <td align="right"><?php echo $data['JumlahProduk']; ?></td>
          <td align="right"><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
          <td align="right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
        </tr>

      <?php } ?>

    </table>

    <hr>

    <table>

      <tr>
        <td><b>Total</b></td>
        <td align="right">
          <b><?php echo "Rp." . number_format($total, 0, ',', '.'); ?></b>
        </td>
      </tr>

    </table>

    <hr>

    <div class="center">
      Terima kasih
    </div>

    <br>

    <div class="center btn-print">

      <button onclick="window.print()">
        Print
      </button>

    </div>

  </div>

</body>

</html>