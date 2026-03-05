<?php
include '../config/koneksi.php';

$query  = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Data Produk</title>
</head>

<body>

  <?php if (
    isset($_GET['status_tambah']) ||
    isset($_GET['status_hapus']) ||
    isset($_GET['status_edit'])
  ): ?>
    <p>
      <?php
      $tambah = $_GET['status_tambah'] ?? null;
      $hapus  = $_GET['status_hapus'] ?? null;
      $edit   = $_GET['status_edit'] ?? null;
      $nama   = $_GET['nama'] ?? '';

      if ($tambah === 'sukses') {
        echo "Produk <b>$nama</b> berhasil ditambahkan!";
      } elseif ($tambah === 'gagal') {
        echo "Produk <b>$nama</b> gagal ditambahkan!";
      } elseif ($hapus === 'sukses') {
        echo "Produk <b>$nama</b> berhasil dihapus!";
      } elseif ($hapus === 'gagal') {
        echo "Produk <b>$nama</b> gagal dihapus!";
      } elseif ($edit === 'sukses') {
        echo "Produk <b>$nama</b> berhasil diperbarui!";
      } elseif ($edit === 'gagal') {
        echo "Produk <b>$nama</b> gagal diperbarui!";
      }
      ?>
    </p>
  <?php endif; ?>

  <h2>Data Produk</h2>
  <a href="form_tambah_produk.php">+ Tambah Produk</a>

  <br><br>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($data = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama_produk']; ?></td>
        <td><b>Rp <?= number_format($data['harga'], 0, ',', '.'); ?></b></td>
        <td><?= $data['stok']; ?></td>
        <td>
          <a href="form_edit_produk.php?id=<?= $data['id_produk']; ?>">Edit</a> |
          <a href="hapus_produk.php?id=<?= $data['id_produk']; ?>&nama=<?= $data['nama_produk']; ?>"
            onclick="return confirm('Yakin ingin menghapus produk ini?')">
            Hapus
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>

</html>