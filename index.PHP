<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require "koneksi.php";
$daftar = $pdo->query(
    "SELECT b.kode, b.nama, k.nama_kategori, b.jumlah, b.kondisi, b.harga
     FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori
     ORDER BY b.id_barang"
)->fetchAll();
$kategoriList = $pdo->query("SELECT * FROM kategori ORDER BY nama_kategori")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-barang</title>
    <link rel="stylesheet" href="style.css">
<header>
    <h1>SIM-Barang</h1>
</header>
<nav>
    <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="#data-barang">Data Barang</a></li>
        <li><a href="#tambah-barang">Tambah Barang</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
<main>
  <section id="data-barang">
    <h2>Daftar Inventaris Barang</h2>
    <input type="text" id="cari" placeholder="Cari barang...">
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach ($daftar as $b): ?>
<tr>
    <td><?= htmlspecialchars($b["kode"]) ?></td>
    <td><?= htmlspecialchars($b["nama"]) ?></td>
    <td><?= htmlspecialchars($b["nama_kategori"]) ?></td>
    <td><?= $b["jumlah"] ?></td>
    <td><?= htmlspecialchars($b["kondisi"]) ?></td>
    <td>Rp <?= number_format($b["harga"], 0, ",", ".") ?></td>
</tr>
<?php endforeach; ?>
            <!-- tambah 2-4 baris lagi -->
        </tbody>
    </table>
</section>
<section id="tambah-barang">
            <h2>Tambah Barang</h2>
            <form id="form-barang" action="simpan.php" method="POST">
                <div>
                    <label for="kode">Kode Barang</label>
                    <input type="text" id="kode" name="kode" placeholder="Contoh: BRG-006" required>
                </div>

                <div>
                    <label for="nama">Nama Barang</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama barang" required>
                </div>

                <div>
                   <select id="kategori" name="kategori" required>
    <option value="">-- Pilih Kategori --</option>
    <?php foreach ($kategoriList as $k): ?>
    <option value="<?= $k["id_kategori"] ?>"><?= htmlspecialchars($k["nama_kategori"]) ?></option>
    <?php endforeach; ?>
</select>
                </div>

                <div>
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Contoh: 10" min="1" required>
                </div>

                <div>
                    <label for="kondisi">Kondisi</label>
                    <select id="kondisi" name="kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="baik">Baik</option>
                        <option value="rusak-ringan">Rusak Ringan</option>
                        <option value="rusak-berat">Rusak Berat</option>
                    </select>
                </div>
                 
                <div>
            <label for="harga">Harga Satuan</label>
            <input type="number" id="harga" name="harga" min="0" placeholder="Contoh: 5000000" required>
                </div>

                <button type="submit">Simpan</button>
            </form>
        </section>
</main>
<footer>
    <p>&copy; 2026 Aflah Muhammad shafin - NIM 062530801574</p>
</footer>
<div id="toast" class="toast"></div>
<script src="main.js"></script>
</body>
</html>
<!-- Pertemuan 2 -->

