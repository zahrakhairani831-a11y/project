<?php
require_once 'products.php';
require_once 'functions.php';

// Bagian Persiapan Data
$totalNilaiStok    = hitungTotalNilaiStok($katalog);
$jumlahJenisProduk = count($katalog);

$jumlahPerluPerhatian = 0;
foreach ($katalog as $produk) {
    if ($produk["stok"] < BATAS_STOK_KRITIS) {
        $jumlahPerluPerhatian++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information System</title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #eef2f6;
            margin: 0;
            padding: 30px 20px;
            color: #222;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
        }

        header.page-header {
            background-color: #1a1a2e;
            color: #fff;
            padding: 25px 30px;
            border-radius: 10px 10px 0 0;
        }

        header.page-header h1 {
            margin: 0 0 6px 0;
            font-size: 24px;
        }

        header.page-header p {
            margin: 0;
            color: #c9c9d6;
            font-size: 14px;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            background: #fff;
            padding: 20px 30px;
        }

        .card {
            background: #f8f9fb;
            border: 1px solid #e2e5eb;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .card .label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .card .value {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a2e;
        }

        .card.alert .value {
            color: #c0392b;
        }

        .table-wrapper {
            background: #fff;
            padding: 0 30px 25px 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        thead th {
            background: #1a1a2e;
            color: #fff;
            text-align: left;
            padding: 10px 12px;
            font-size: 13px;
            white-space: nowrap;
        }

        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e5eb;
            font-size: 14px;
            vertical-align: top;
        }

        td.col-id, td.col-kategori, td.col-harga, td.col-stok {
            white-space: nowrap;
        }

        
        col.col-id       { width: 9%; }
        col.col-nama     { width: 16%; }
        col.col-kategori { width: 11%; }
        col.col-harga    { width: 12%; }
        col.col-stok     { width: 7%; }
        col.col-deskripsi{ width: 32%; }
        col.col-status   { width: 13%; }

        tbody tr.row-kritis { background-color: #fdf3d0; }
        tbody tr.row-habis  { background-color: #fbdada; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-aman   { background: #d9f2e0; color: #1e7e34; }
        .badge-kritis { background: #fbe8a6; color: #8a6100; }
        .badge-habis  { background: #f5c2c2; color: #a12727; }

        footer.page-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>
<div class="container">

    <header class="page-header">
        <h1>SYSTEM HITUNG INFORMASI TOKO</h1>
        <p>Zahra Khairani - 250180073</p>
    </header>

    <section class="summary-cards">
        <div class="card">
            <div class="label">Total Nilai Aset Gudang</div>
            <div class="value"><?php echo formatRupiah($totalNilaiStok); ?></div>
        </div>
        <div class="card">
            <div class="label">Jumlah Jenis Produk</div>
            <div class="value"><?php echo $jumlahJenisProduk; ?> Produk</div>
        </div>
        <div class="card <?php echo $jumlahPerluPerhatian > 0 ? 'alert' : ''; ?>">
            <div class="label">Produk Perlu Perhatian</div>
            <div class="value"><?php echo $jumlahPerluPerhatian; ?> Item</div>
        </div>
    </section>

    <section class="table-wrapper">
        <table>
            <colgroup>
                <col class="col-id">
                <col class="col-nama">
                <col class="col-kategori">
                <col class="col-harga">
                <col class="col-stok">
                <col class="col-deskripsi">
                <col class="col-status">
            </colgroup>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($katalog as $produk): ?>
                    <?php
                        // Olah Data
                        $warnaBaris  = getWarnaBarisStok($produk["stok"]);
                        $labelStatus = getLabelStatusStok($produk["stok"]);

                        if ($labelStatus === "Stok Habis") {
                            $badgeClass = "badge-habis";
                        } elseif ($labelStatus === "Stok Kritis") {
                            $badgeClass = "badge-kritis";
                        } else {
                            $badgeClass = "badge-aman";
                        }
                    ?>
                    <tr class="<?php echo $warnaBaris; ?>">
                        <td><?php echo htmlspecialchars($produk["id"]); ?></td>
                        <td><?php echo htmlspecialchars($produk["nama"]); ?></td>
                        <td><?php echo htmlspecialchars($produk["kategori"]); ?></td>
                        <td><?php echo formatRupiah($produk["harga"]); ?></td>
                        <td><?php echo $produk["stok"]; ?></td>
                        <td><?php echo htmlspecialchars($produk["deskripsi"]); ?></td>
                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $labelStatus; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <footer class="page-footer">
        &copy; <?php echo date("Y"); ?> Zahra Khairani - 250180073
    </footer>
</div>
</body>
</html>