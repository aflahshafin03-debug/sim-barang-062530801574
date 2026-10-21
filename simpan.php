<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require "Barang.php";
function hitungTotal($jumlah, $harga) {
    return $jumlah * $harga;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$kode     = htmlspecialchars($_POST["kode"]);
$nama     = htmlspecialchars($_POST["nama"]);
$kategori = htmlspecialchars($_POST["kategori"]);
$kondisi  = htmlspecialchars($_POST["kondisi"]);
$jumlah   = (int) $_POST["jumlah"];
$harga    = (float) $_POST["harga"];
$total    = hitungTotal($jumlah, $harga);
$barang = new Barang($kode, $nama, $jumlah);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ringkasan Input</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Ringkasan Data Barang</h1>
  <table border="1">
    <tr><th>Kode</th><td><?= $kode ?></td></tr>
    <tr><th>Nama</th><td><?= $nama ?></td></tr>
    <tr><th>Kategori</th><td><?= $kategori ?></td></tr>
    <tr><th>Kondisi</th><td><?= $kondisi ?></td></tr>
    <tr><th>Jumlah</th><td><?= $jumlah ?></td></tr>
    <tr><th>Harga Satuan</th><td>Rp <?= number_format($harga, 0, ",", ".") ?></td></tr>
    <tr><th>Total Nilai Aset</th><td>Rp <?= number_format($total, 0, ",", ".") ?></td></tr>
  </table>
  <p><?= $barang->tampilkanInfo() ?></p>
  <p><a href="index.html">Kembali</a></p>
</body>
</html>