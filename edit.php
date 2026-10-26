<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: login.php"); exit; }
require "koneksi.php";

$id = (int) ($_GET["id"] ?? $_POST["id_barang"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare(
        "UPDATE barang SET kode=?, nama=?, id_kategori=?, jumlah=?, kondisi=?, harga=?
         WHERE id_barang=?"
    );
    $stmt->execute([
        trim($_POST["kode"]), trim($_POST["nama"]), (int) $_POST["kategori"],
        (int) $_POST["jumlah"], $_POST["kondisi"], (float) $_POST["harga"], $id
    ]);
    header("Location: index.php?pesan=diubah");
    exit;
}

$q = $pdo->prepare("SELECT * FROM barang WHERE id_barang = ?");
$q->execute([$id]);
$b = $q->fetch();
if (!$b) { header("Location: index.php"); exit; }

$kategoriList = $pdo->query("SELECT * FROM kategori ORDER BY nama_kategori")->fetchAll();
$kondisiList = ["baik" => "Baik", "rusak-ringan" => "Rusak Ringan", "rusak-berat" => "Rusak Berat"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Barang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
    <section>
      <h2>Edit Barang</h2>
      <form method="POST" action="edit.php" id="form-barang">
        <input type="hidden" name="id_barang" value="<?= $b["id_barang"] ?>">

        <div>
          <label for="kode">Kode Barang</label>
          <input type="text" id="kode" name="kode" value="<?= htmlspecialchars($b["kode"]) ?>" required>
        </div>
        <div>
          <label for="nama">Nama Barang</label>
          <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($b["nama"]) ?>" required>
        </div>
        <div>
          <label for="kategori">Kategori</label>
          <select id="kategori" name="kategori" required>
            <?php foreach ($kategoriList as $k): ?>
              <option value="<?= $k["id_kategori"] ?>" <?= $k["id_kategori"] == $b["id_kategori"] ? "selected" : "" ?>>
                <?= htmlspecialchars($k["nama_kategori"]) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label for="jumlah">Jumlah</label>
          <input type="number" id="jumlah" name="jumlah" min="1" value="<?= $b["jumlah"] ?>" required>
        </div>
        <div>
          <label for="kondisi">Kondisi</label>
          <select id="kondisi" name="kondisi" required>
            <?php foreach ($kondisiList as $nilai => $label): ?>
              <option value="<?= $nilai ?>" <?= $nilai === $b["kondisi"] ? "selected" : "" ?>><?= $label ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label for="harga">Harga Satuan</label>
          <input type="number" id="harga" name="harga" min="0" value="<?= (int) $b["harga"] ?>" required>
        </div>

        <button type="submit">Simpan Perubahan</button>
        <p><a href="index.php">Batal</a></p>
      </form>
    </section>
  </main>
</body>
</html>