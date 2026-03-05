<?php

include "../config/koneksi.php";

$query = mysqli_query($koneksi, "
SELECT
    p.penjualanID,
    p.tanggalpenjualan,
    p.totalharga,
    p1.namapelanggan,
    p1.alamat,
    p1.nomortelepon
FROM penjualan p
JOIN pelanggan p1 ON p.pelangganID = p1.pelangganID
ORDER BY p.penjualanID DESC
");

if (!$query) {
  die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data transaksi</title>
</head>

<body>

  <h2>Data Transaksi Penjualan</h2>

  <a href="form_tambah.php">+ Tambah Transaksi</a>
  <br><br>

  <!-- Pesan Informasi -->
  <?php if (isset($_GET['status_tambah']) || isset($_GET['status_hapus']) || isset($_GET['status_edit'])): ?>
    <p>
      <?php
      $tambah = $_GET['status_tambah'] ?? null;
      $hapus  = $_GET['status_hapus'] ?? null;
      $edit   = $_GET['status_edit'] ?? null;
      $nama   = $_GET['nama'] ?? '';

      if ($tambah === 'sukses') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> berhasil ditambahkan!";
      } elseif ($tambah === 'gagal') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> gagal ditambahkan!";
      } elseif ($hapus === 'sukses') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> berhasil dihapus!";
      } elseif ($hapus === 'gagal') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> gagal dihapus!";
      } elseif ($edit === 'sukses') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> berhasil diperbarui!";
      } elseif ($edit === 'gagal') {
        echo "Transaksi dengan nama pelanggan <b>$nama</b> gagal diperbarui!";
      }
      ?>
    </p>
  <?php endif; ?>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Penjualan ID</th>
      <th>Nama Pelanggan</th>
      <th>Alamat</th>
      <th>No Telepon</th>
      <th>Tanggal Penjualan</th>
      <th>Total Harga</th>
      <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    while ($data = mysqli_fetch_assoc($query)) {
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($data['penjualanID']) ?></td>
        <td><?= htmlspecialchars($data['namapelanggan']) ?></td>
        <td><?= htmlspecialchars($data['alamat']) ?></td>
        <td><?= htmlspecialchars($data['nomortelepon']) ?></td>
        <td><?= date('d-m-Y', strtotime($data['tanggalpenjualan'])) ?></td>
        <td>Rp <?= number_format((float)$data['totalharga'], 0, ',', '.') ?></td>
        <td>
          <a href="form_edit.php?penjualanID=<?= urlencode($data['penjualanID']) ?>">detail</a> |
          <a href="hapus.php?penjualanID=<?= urlencode($data['penjualanID']) ?>&nama=<?= urlencode($data['namapelanggan']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>