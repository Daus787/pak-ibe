<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "kasir_daus";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  die("koneksi database gagal: " . mysqli_connect_error());
  // } else{
  //     echo "koneksi berhasil";
}
