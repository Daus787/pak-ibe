<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  die("ID produk tidak ditemukan");
}

$id = $_GET['id'];

$query  = "SELECT * FROM produk WHERE id_produk = '$id'";
$result = mysqli_query($koneksi, $query);
$data   = mysqli_fetch_assoc($result);

if (!$data) {
  die("Data produk tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
</head>

<body>

  <h1>Edit Produk</h1>

  <form method="post" action="proses_edit_produk.php">
    <input type="hidden" name="id_produk" value="<?= $data['id_produk']; ?>">

    <label>Nama Produk</label><br>
    <input type="text" name="nama_produk" value="<?= $data['nama_produk']; ?>" required>
    <br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" value="<?= $data['harga']; ?>" required>
    <br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="<?= $data['stok']; ?>" required>
    <br><br>

    <button type="submit" name="simpan">Simpan Perubahan</button>
  </form>

</body>

</html>