<?php
include "../config/koneksi.php";

$pelanggan = mysqli_query($koneksi, "SELECT pelangganID, namapelanggan FROM pelanggan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tambah transaksi</title>
</head>

<body>
  <h2>tambah transaksi</h2>

  <form action="tambah.php" method="POST">
    <p>
      <label>tanggal transaksi</label>
      <input type="date" name="tanggal" required>
    </p>
    <p>
      <label for="">Pelanggan</label>
      <select name="pelangganID" id="pelangganID" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
          <option value="<?php echo $p['pelangganID']; ?>">
            <?php echo $p['namapelanggan']; ?>
          </option>
        <?php endwhile; ?>
      </select>
    </p>
    <p>
      <button type="submit" name="simpan">Simpan</button>
      <a href="index_trans.php">Batal</a>
    </p>
  </form>
</body>

</html>