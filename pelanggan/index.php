<?php
include '../config/koneksi.php';

$query  = "SELECT * FROM pelanggan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tampilan Pelanggan</title>
</head>

<body>

  <?php if (
    isset($_GET['status_tambah']) || isset($_GET['status_hapus']) || isset($_GET['status_edit'])


  ): ?>
    <p>
      <?php
      $tambah      = $_GET['status_tambah'] ?? null;
      $hapus       = $_GET['status_hapus'] ?? null;
      $status_edit = $_GET['status_edit'] ?? null;
      $nama        = $_GET['nama'] ?? '';

      if ($tambah === 'sukses') {
        echo "Pendaftaran pelanggan baru dengan nama <b>$nama</b> berhasil!";
      } elseif ($tambah === 'gagal') {
        echo "Pendaftaran pelanggan baru dengan nama <b>$nama</b> gagal!";
      } elseif ($hapus === 'sukses') {
        echo "Pelanggan atas nama <b>$nama</b> berhasil dihapus!";
      } elseif ($hapus === 'gagal') {
        echo "Pelanggan atas nama <b>$nama</b> gagal dihapus!";
      } elseif ($status_edit === 'success') {
        echo "Data pelanggan dengan nama <b>$nama</b> berhasil diperbarui!";
      } elseif ($status_edit === 'gagal') {
        echo "Data pelanggan dengan nama <b>$nama</b> gagal diperbarui!";
      }
      ?>
    </p>
  <?php endif; ?>

  <h2>Data Pelanggan</h2>
  <a href="form_tambah.php">Tambah Pelanggan</a>

  <br><br>

  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Pelanggan</th>
      <th>Alamat</th>
      <th>No Telepon</th>
      <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($data = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['Namapelanggan']; ?></td>
        <td><?= $data['Alamat']; ?></td>
        <td><?= $data['NomorTelepon']; ?></td>
        <td>
          <a href="form_edit.php?id=<?= $data['pelangganID']; ?>">Edit</a> |
          <a href="hapus.php?id=<?= $data['pelangganID']; ?>&nama=<?= $data['Namapelanggan']; ?>"
            onclick="return confirm('Yakin ingin menghapus data ini?')">
            Hapus
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>

</html>