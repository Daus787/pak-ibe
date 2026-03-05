<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {

  $id     = $_POST['id'];
  $nama   = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $telp   = $_POST['telp'];

  $query = "UPDATE Pelanggan SET
                NamaPelanggan = '$nama',
                Alamat = '$alamat',
                NomorTelepon = '$telp'
              WHERE PelangganID = '$id'";

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    header("Location: index.php?status_edit=success&nama=" . $nama);
  } else {
    header("Location: index.php?status_edit=gagal&nama=" . $nama);
  }
} else {
  die("Akses dilarang...");
}
