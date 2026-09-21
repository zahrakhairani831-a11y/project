# Product Information System

Aplikasi sederhana berbasis PHP untuk mengelola dan menampilkan data informasi produk, dibuat sebagai tugas Mini Project mata kuliah **Pemrograman Web** (Pertemuan 2: PHP Fundamental & Data Structure).

## Deskripsi

Aplikasi ini menampilkan katalog produk dalam bentuk tabel, lengkap dengan:
- Ringkasan total nilai aset gudang (harga × stok semua produk)
- Jumlah jenis produk yang tersedia
- Deteksi otomatis produk dengan stok kritis (< 3) atau stok habis (0), ditandai dengan warna baris dan badge status

## Arsitektur

Project ini dibangun mengikuti prinsip **modular programming** dengan memisahkan tanggung jawab tiap file menjadi 3 layer:

| File | Layer | Tanggung Jawab |
|---|---|---|
| `products.php` | Data Layer | Menyimpan data produk dalam bentuk multidimensional array (ID, Nama, Kategori, Harga, Stok, Deskripsi) |
| `functions.php` | Processing Layer | Berisi fungsi bisnis: `hitungTotalNilaiStok()`, penentuan status stok, dan format Rupiah |
| `index.php` | Presentation Layer | Merajut Data Layer & Processing Layer menggunakan `require_once`, lalu merender tampilan HTML |

## Struktur Folder

```
project/
├── index.php       # Halaman utama (entry point)
├── products.php    # Data produk
├── functions.php   # Fungsi-fungsi bisnis
└── README.md
```

## Cara Menjalankan

1. Pastikan sudah menginstall web server lokal seperti [XAMPP](https://www.apachefriends.org/) atau [Laragon](https://laragon.org/).
2. Copy seluruh folder project ke dalam folder `htdocs` (XAMPP) atau `www` (Laragon).
   Contoh: `C:\xampp\htdocs\project\`
3. Jalankan Apache lewat XAMPP Control Panel / Laragon.
4. Buka browser dan akses:
   ```
   http://localhost/project/index.php
   ```

## Fitur

- Tabel katalog produk dengan kolom ID, Nama, Kategori, Harga, Stok, Deskripsi, dan Status
- Highlight otomatis baris tabel:
  - 🟡 Kuning → Stok Kritis (stok < 3)
  - 🔴 Merah → Stok Habis (stok = 0)
  - Putih → Stok Aman
- Kartu ringkasan total nilai aset gudang & jumlah produk perlu perhatian
- Layout responsif dan tampilan bersih menggunakan HTML + CSS murni (tanpa framework eksternal)

## Aturan Bisnis

- Stok dianggap **kritis** apabila jumlahnya kurang dari 3 (`BATAS_STOK_KRITIS`, didefinisikan di `functions.php`)
- Total nilai aset gudang dihitung dengan rumus: `Σ (harga × stok)` untuk seluruh produk

## Teknologi

- PHP (native, tanpa framework)
- HTML5 & CSS3

## Mata Kuliah

Pemrograman Web — Pertemuan 2: PHP Fundamental & Data Structure
