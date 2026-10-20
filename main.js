// ===== Pertemuan 4: Validasi Form & Interaksi DOM =====

// Ambil elemen yang dibutuhkan
const form = document.getElementById("form-barang");
const inputKode = document.getElementById("kode");
const inputNama = document.getElementById("nama");
const inputKategori = document.getElementById("kategori");
const inputJumlah = document.getElementById("jumlah");
const inputKondisi = document.getElementById("kondisi");
const inputCari = document.getElementById("cari");
const tabelBody = document.querySelector("#data-barang tbody");
const toast = document.getElementById("toast");

// ----- Fungsi bantu: tampilkan / hapus pesan error di bawah input -----
function tampilkanError(input, pesan) {
    hapusError(input);
    const p = document.createElement("small");
    p.className = "error";
    p.textContent = pesan;
    input.parentElement.appendChild(p);
}

function hapusError(input) {
    const lama = input.parentElement.querySelector(".error");
    if (lama) {
        lama.remove();
    }
}

// ----- Fitur 2: Toast notifikasi -----
let timerToast;

function tampilkanToast(pesan) {
    toast.textContent = pesan;
    toast.classList.add("tampil");
    clearTimeout(timerToast);
    timerToast = setTimeout(function () {
        toast.classList.remove("tampil");
    }, 3000);
}

// ----- Validasi saat form di-submit -----
form.addEventListener("submit", function (event) {
    // Hentikan pengiriman form, kita validasi dulu
    event.preventDefault();

    let valid = true;

    // Kode barang: wajib diawali "BRG-" lalu angka (contoh: BRG-001)
    const kode = inputKode.value.trim();
    const polaKode = /^BRG-\d+$/;
    if (!polaKode.test(kode)) {
        tampilkanError(inputKode, "Kode harus diawali BRG- diikuti angka, contoh: BRG-001");
        valid = false;
    } else {
        hapusError(inputKode);
    }

    // Jumlah: harus angka positif (> 0)
    const jumlah = Number(inputJumlah.value);
    if (isNaN(jumlah) || jumlah <= 0) {
        tampilkanError(inputJumlah, "Jumlah harus berupa angka lebih dari 0");
        valid = false;
    } else {
        hapusError(inputJumlah);
    }

    // Jika ada yang salah, berhenti di sini
    if (!valid) {
        return;
    }

    // Validasi lolos: tambahkan baris baru ke tabel (data hanya tampil sementara)
    const baris = document.createElement("tr");
    const dataBaris = [
        kode,
        inputNama.value.trim(),
        inputKategori.options[inputKategori.selectedIndex].text,
        jumlah,
        inputKondisi.options[inputKondisi.selectedIndex].text
    ];

    dataBaris.forEach(function (isi) {
        const sel = document.createElement("td");
        sel.textContent = isi;
        baris.appendChild(sel);
    });

    tabelBody.appendChild(baris);

    tampilkanToast("Barang " + kode + " berhasil divalidasi dan ditambahkan.");
    form.reset();
});

// Hapus pesan error saat pengguna mulai mengetik ulang
inputKode.addEventListener("input", function () {
    hapusError(inputKode);
});
inputJumlah.addEventListener("input", function () {
    hapusError(inputJumlah);
});

// ----- Fitur 1: Pencarian / filter tabel real-time -----
inputCari.addEventListener("input", function () {
    const kataKunci = inputCari.value.toLowerCase();
    const semuaBaris = tabelBody.querySelectorAll("tr");

    semuaBaris.forEach(function (baris) {
        const teks = baris.textContent.toLowerCase();
        if (teks.includes(kataKunci)) {
            baris.style.display = "";
        } else {
            baris.style.display = "none";
        }
    });
});