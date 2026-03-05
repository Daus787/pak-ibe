<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
</head>

<body>

  <h1>Tambah Produk</h1>

  <form method="post" action="proses_tambah_produk.php">
    <label>Nama Produk</label><br>
    <input type="text" name="nama_produk" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" required><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" required><br><br>

    <input type="submit" name="simpan" value="Simpan">
  </form>

</body>

</html>