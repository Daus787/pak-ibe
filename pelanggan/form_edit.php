<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  die("ID tidak ditemukan");
}

$id = $_GET['id'];

$query  = "SELECT * FROM pelanggan WHERE PelangganID = '$id'";
$result = mysqli_query($koneksi, $query);
$data   = mysqli_fetch_assoc($result);

if (!$data) {
  die("Data pelanggan tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Pelanggan</title>
</head>

<body>

  <h1>Edit Pelanggan</h1>

  <form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?= $data['pelangganID']; ?>">

    <label> Nama Pelanggan </label><br>
    <input type="text" name="nama" value="<?= $data['Namapelanggan']; ?>">
    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= $data['Alamat']; ?></textarea>
    <br><br>

    <label>No Telepon</label><br>
    <input type="text" name="telp" value="<?= $data['NomorTelepon']; ?>" required>
    <br><br>

    <button type="submit" name="simpan">Simpan Perubahan</button>
  </form>

</body>

</html>