<?php
define("BATAS_STOK_KRITIS", 3);
function hitungTotalNilaiStok(array $katalog): int
{
    $total = 0;

    foreach ($katalog as $produk) {
        $total += $produk["harga"] * $produk["stok"];
    }

    return $total;
}

function getWarnaBarisStok(int $stok): string
{
    if ($stok === 0) {
        return "row-habis";
    } elseif ($stok < BATAS_STOK_KRITIS) {
        return "row-kritis";
    } else {
        return "row-aman";
    }
}

function getLabelStatusStok(int $stok): string
{
    if ($stok === 0) {
        return "Stok Habis";
    } elseif ($stok < BATAS_STOK_KRITIS) {
        return "Stok Kritis";
    } else {
        return "Stok Aman";
    }
}

function formatRupiah(int $angka): string
{
    return "Rp " . number_format($angka, 0, ",", ".");
}