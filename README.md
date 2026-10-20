# SIM-Barang

Sistem Informasi Manajemen Inventaris Barang Jurusan
Praktikum Pemrograman Web, D3 Manajemen Informatika, Politeknik Negeri Sriwijaya

## Gambaran Proyek
SIM-Barang adalah sistem pencatatan dan pengelolaan inventaris barang jurusan; sebutkan fungsinya (mencatat, mengelola, memantau aset).
SIM-Barang adalah sistem pencatatan, pengelolaan, dan pemantauan sarana dan prasarana (aset/barang) laboratorium dan jurusan secara terintegrasi. Proyek dikembangkan bertahap dari Pertemuan 1 sampai 7: dari penyiapan lingkungan kerja, antarmuka HTML, CSS responsif, validasi JavaScript, sampai logika backend PHP dan basis data MySQL.

## HTTP Request dan Response
request adalah permintaan dari browser ke server, response adalah jawaban server; sebutkan method GET dan POST, 
HTTP (HyperText Transfer Protocol) adalah protokol komunikasi antara klien (browser) dan server web.

*Request* adalah permintaan dari browser ke server. Isinya:
- Method (GET, POST, dll.)
- URL tujuan
- Header (jenis browser, tipe data, dll.)
- Body (opsional, berisi data form pada POST)

*Response* adalah jawaban server ke browser. Isinya:
- Status code
- Header (tipe konten, dll.)
- Body (HTML, JSON, gambar, dll.)

### Method yang dipakai di proyek ini
| Method | Fungsi | Contoh di SIM-Barang |
|--------|--------|----------------------|
| GET | Mengambil data; parameter tampil di URL | Membuka halaman daftar barang |
| POST | Mengirim data; data ada di body request | Submit form tambah barang |

### Status code umum
| Kode | Arti |
|------|------|
| 200 OK | Permintaan berhasil |
| 301/302 | Pengalihan (redirect) |
| 404 Not Found | Halaman tidak ditemukan |
| 500 Internal Server Error | Kesalahan di sisi server |

### Alur singkat
1. Pengguna membuka halaman atau mengirim form di browser
2. Browser mengirim HTTP request ke server (Apache/Laragon)
3. Server (PHP) memproses dan mengakses MySQL bila perlu
4. Server mengirim HTTP response berisi halaman HTML
5. Browser menampilkan hasilnya

## Teknologi
HTML, CSS, JavaScript, PHP, MySQL
HTML, CSS, JavaScript, PHP, MySQL

## Roadmap Pertemuan
- [x] Pertemuan 1: Setup lingkungan kerja, Git, dan README
- [ ] Pertemuan 2: Struktur HTML5 semantik, tabel, dan form
- [ ] Pertemuan 3: CSS3 responsif (Flexbox, Grid, Media Query)
- [ ] Pertemuan 4: Validasi form dan interaksi DOM (JavaScript)
- [ ] Pertemuan 5: Pengolahan form dengan PHP native (POST)
- [ ] Pertemuan 6: Login, session, dan OOP dasar
- [ ] Pertemuan 7: Desain ERD dan integrasi PHP-MySQL

## Cara Menjalankan
1. Clone repositori ini
2. Letakkan folder di htdocs (XAMPP) atau www (Laragon)
3. Jalankan Apache dan MySQL
4. Buka http://localhost/sim-barang di browser

<!-- Pertemuan 1 -->


