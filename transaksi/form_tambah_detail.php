<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  die("Akses dilarang...");
}

$penjualanID = $_GET['id'];

$query_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok > 0 ORDER BY nama_produk ASC");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tambah Produk Ke Transaksi</title>
</head>

<body>
  <h2>Tambah Produk Ke Transaksi</h2>

  <?php if (isset($_GET['error'])): ?>
    <p style="color: red;">
      <?php if ($_GET['error'] == 'stok_tidak_cukup'): ?>
        Stok produk tidak cukup!
      <?php elseif ($_GET['error'] == 'insert_gagal'): ?>
        Gagal menambahkan produk!
      <?php endif; ?>
    </p>
  <?php endif; ?>

  <form method="POST" action="tambah_detail.php">

    <!-- Kirim ID transaksi -->
    <input type="hidden" name="penjualanID" value="<?= $penjualanID; ?>">

    <label for="produkID">Produk:</label>
    <select name="produkID" id="produkID" required>
      <option value="">Pilih Produk</option>
      <?php
      $query_produk = mysqli_query($koneksi, "SELECT id_produk, nama_produk, harga, stok FROM produk");
      while ($produk = mysqli_fetch_assoc($query_produk)) {
        $harga_formatted = number_format($produk['harga'], 0, ',', '.');
        echo "<option value='{$produk['id_produk']}' data-harga='{$produk['harga']}' data-stok='{$produk['stok']}'>{$produk['nama_produk']} - Harga: Rp {$harga_formatted} - Stok: {$produk['stok']}</option>";
      }
      ?>
    </select>
    <br><br>

    <label for="jumlah">Jumlah:</label>
    <input type="number" name="jumlah" id="jumlah" min="1" required>
    <br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="detail.php?penjualanID=<?= $penjualanID; ?>">Kembali</a>
  </form>

  <br>
  <a href="detail.php?penjualanID=<?= $penjualanID; ?>">Kembali ke Detail Transaksi</a>
</body>