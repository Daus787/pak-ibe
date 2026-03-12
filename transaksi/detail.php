<?php
include '../config/koneksi.php';

// Cek apakah ID transaksi dikirim
if (!isset($_GET['penjualanID'])) {
  die("Akses dilarang...");
}

$id = $_GET['penjualanID'];

// Ambil data transaksi (header)
$query_transaksi = mysqli_query($koneksi, "
    SELECT 
        p.PenjualanID,
        p.TanggalPenjualan,
        p.TotalHarga,
        pl.NamaPelanggan
    FROM Penjualan p
    JOIN Pelanggan pl ON p.PelangganID = pl.PelangganID
    WHERE p.PenjualanID = '$id'
");
$transaksi = mysqli_fetch_assoc($query_transaksi);

// Ambil detail transaksi (produk)
$query_detail = mysqli_query($koneksi, "
    SELECT detailpenjualan.*, produk.nama_produk, produk.harga
    FROM detailpenjualan
    JOIN produk ON detailpenjualan.ProdukID = produk.id_produk
    WHERE detailpenjualan.PenjualanID = '$id'
");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Detail Transaksi</title>
</head>

<body>
  <h2>Detail Transaksi</h2>

  <?php if (isset($_GET['success'])): ?>
    <p style="color: green;">
      <?php if ($_GET['success'] == 'tambah_detail'): ?>
        Produk berhasil ditambahkan ke transaksi!
      <?php elseif ($_GET['success'] == 'hapus_detail'): ?>
        Produk berhasil dihapus dari transaksi!
      <?php endif; ?>
    </p>
  <?php endif; ?>

  <?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
      <?php if ($_GET['error'] == 'detail_tidak_ditemukan'): ?>
        Detail tidak ditemukan!
      <?php endif; ?>
    </p>
  <?php endif; ?>

  <table border="0" cellpadding="5">
    <tr>
      <td>ID Transaksi</td>
      <td>: <?= $transaksi['PenjualanID']; ?></td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>: <?= date('d-m-Y', strtotime($transaksi['TanggalPenjualan'])); ?></td>
    </tr>

    <tr>
      <td>Nama Pelanggan</td>
      <td>: <?= $transaksi['NamaPelanggan']; ?></td>
    </tr>
  </table>

  <br>

  <a href="form_tambah_detail.php?id=<?= $id; ?>">+ Tambah Produk</a>
  <br><br>

  <!-- Detail produk -->
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $total = 0;

    while ($data = mysqli_fetch_assoc($query_detail)) {
      $subtotal = $data['harga'] * $data['JumlahProduk'];
      $total += $subtotal;
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama_produk']; ?></td>
        <td>Rp. <?= number_format($data['harga'], 0, ',', '.'); ?></td>
        <td><?= $data['JumlahProduk']; ?></td>
        <td>Rp. <?= number_format($subtotal, 0, ',', '.'); ?></td>
        <td>
          <a href="hapus_detail.php?id=<?= $data['DetailID']; ?>&penjualanID=<?= $id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari transaksi?')">
            Hapus
          </a>
        </td>
      </tr>
    <?php } ?>

    <tr>
      <th colspan="4">Total</th>
      <th colspan="2">Rp. <?= number_format($total, 0, ',', '.'); ?></th>
    </tr>
  </table>
  <br>
  <a href="index_trans.php">Kembali ke Daftar Transaksi</a>
</body>