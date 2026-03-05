<?php 
include "../config/koneksi.php";

if (isset($_GET['penjualanID'])) {
  $penjualanID = $_GET['penjualanID'];

  $query = mysqli_query($koneksi, "DELETE FROM penjualan WHERE penjualanID = '$penjualanID'");

  if ($query) {
    header("Location: index_trans.php?pesan=berhasil");
  } else {
    die("Delete gagal: " . mysqli_error($koneksi));
  }
}
