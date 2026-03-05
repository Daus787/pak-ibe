<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $telp   = $_POST['telp'];

  $sql = "INSERT INTO pelanggan 
            (Namapelanggan, Alamat, NomorTelepon)
            VALUES ('$nama', '$alamat', '$telp')";

  $query = mysqli_query($koneksi, $sql);

  if ($query) {
    header('Location: index.php?status_tambah=sukses&nama=' . $nama);
  } else {
    header('Location: index.php?status_tambah=gagal&nama=' . $nama);
  }
  die("Akses dilarang...");
}
