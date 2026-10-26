<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id_barang = ?");
    $stmt->execute([(int) $_POST["id_barang"]]);
}
header("Location: index.php?pesan=dihapus");
exit;