<?php
require_once "FilmBioskop.php";

// Fungsi untuk membuat 5 objek awal
function getInitialMovies(): array {
    return [
        new FilmBioskop("FB01", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000, "avengers_endgame.jpg"),
        new FilmBioskop("FB02", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000, "interstellar.jpg"),
        new FilmBioskop("FB03", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000, "spiderman_brand_new_day.jpg"),
        new FilmBioskop("FB04", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000, "thor_ragnarok.jpg"),
        new FilmBioskop("FB05", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000, "oppenheimer.jpg")
    ];
}

// Mode CLI (jika dijalankan via terminal: php index.php < file.txt)
if (php_sapi_name() === 'cli') {
    $daftar = getInitialMovies();

    // Fungsi tabel dinamis untuk CLI
    function printCliTable($list, $title) {
        echo "\n" . $title . "\n";
        $headers = ["ID", "Judul", "Tahun", "Sutradara", "Genre", "Durasi", "Studio Produksi", "Rating Usia", "Harga Tiket", "Foto Produk"];
        $widths = array_map('strlen', $headers);

        $rows = [];
        foreach ($list as $f) {
            $row = [
                $f->getId(),
                $f->getJudul(),
                (string)$f->getTahunRilis(),
                $f->getSutradara(),
                $f->getGenre(),
                $f->getDurasi() . " mnt",
                $f->getStudioProduksi(),
                $f->getRatingUsia(),
                "Rp " . $f->getHargaTiket(),
                $f->getFotoProduk()
            ];
            for ($i = 0; $i < count($headers); $i++) {
                if (strlen($row[$i]) > $widths[$i]) {
                    $widths[$i] = strlen($row[$i]);
                }
            }
            $rows[] = $row;
        }

        $line = "+";
        foreach ($widths as $w) {
            $line .= str_repeat("-", $w + 2) . "+";
        }

        echo $line . "\n|";
        for ($i = 0; $i < count($headers); $i++) {
            echo " " . str_pad($headers[$i], $widths[$i]) . " |";
        }
        echo "\n" . $line . "\n";

        foreach ($rows as $r) {
            echo "|";
            for ($i = 0; $i < count($headers); $i++) {
                echo " " . str_pad($r[$i], $widths[$i]) . " |";
            }
            echo "\n";
        }
        echo $line . "\n";
    }

    printCliTable($daftar, "=== DATA AWAL FILM BIOSKOP (5 OBJEK) ===");

    echo "\nMasukkan jumlah film yang ingin ditambahkan: ";
    $nLine = trim(fgets(STDIN));
    if ($nLine !== "" && is_numeric($nLine)) {
        $n = (int)$nLine;
        for ($i = 1; $i <= $n; $i++) {
            echo "\n--- Input Data Film ke-{$i} ---\n";
            echo "ID Media            : "; $id = trim(fgets(STDIN));
            echo "Judul Film          : "; $judul = trim(fgets(STDIN));
            echo "Tahun Rilis         : "; $tahun = (int)trim(fgets(STDIN));
            echo "Sutradara           : "; $sutradara = trim(fgets(STDIN));
            echo "Genre               : "; $genre = trim(fgets(STDIN));
            echo "Durasi (menit)      : "; $durasi = (int)trim(fgets(STDIN));
            echo "Studio Produksi     : "; $studio = trim(fgets(STDIN));
            echo "Rating Usia         : "; $rating = trim(fgets(STDIN));
            echo "Harga Tiket (Rp)    : "; $harga = (int)trim(fgets(STDIN));
            $foto = "dune_part_two.jpg";

            $filmBaru = new FilmBioskop($id, $judul, $tahun, $sutradara, $genre, $durasi, $studio, $rating, $harga, $foto);
            $daftar[] = $filmBaru;
            echo "Data film \"{$judul}\" berhasil ditambahkan!\n";
        }
        printCliTable($daftar, "=== DATA SELURUH FILM BIOSKOP SETELAH PENAMBAHAN ===");
    }
    exit(0);
}

// Mode Web (Browser)
session_start();

// Inisialisasi session jika belum ada
if (!isset($_SESSION['daftar_film'])) {
    $_SESSION['daftar_film'] = serialize(getInitialMovies());
}

// Fitur Reset ke 5 data awal
if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    $_SESSION['daftar_film'] = serialize(getInitialMovies());
    header("Location: index.php");
    exit();
}

$pesanSukses = "";
$pesanError = "";

// Handle Form Submit (Add Data)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_film'])) {
    $id = trim($_POST['id'] ?? '');
    $judul = trim($_POST['judul'] ?? '');
    $tahunRilis = (int)($_POST['tahunRilis'] ?? 0);
    $sutradara = trim($_POST['sutradara'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $durasi = (int)($_POST['durasi'] ?? 0);
    $studio = trim($_POST['studioProduksi'] ?? '');
    $rating = trim($_POST['ratingUsia'] ?? '');
    $harga = (int)($_POST['hargaTiket'] ?? 0);
    $foto = "dune_part_two.jpg"; // default poster

    // Cek upload file poster
    if (isset($_FILES['foto_produk']) && $_FILES['foto_produk']['error'] === UPLOAD_ERR_OK) {
        $namaFile = basename($_FILES['foto_produk']['name']);
        $targetDir = __DIR__ . "/image/";
        $targetFile = $targetDir . $namaFile;
        if (move_uploaded_file($_FILES['foto_produk']['tmp_name'], $targetFile)) {
            $foto = $namaFile;
        }
    } elseif (!empty($_POST['foto_custom'])) {
        $foto = trim($_POST['foto_custom']);
    }

    if (!empty($id) && !empty($judul)) {
        $daftarFilm = unserialize($_SESSION['daftar_film']);
        $filmBaru = new FilmBioskop($id, $judul, $tahunRilis, $sutradara, $genre, $durasi, $studio, $rating, $harga, $foto);
        $daftarFilm[] = $filmBaru;
        $_SESSION['daftar_film'] = serialize($daftarFilm);
        $pesanSukses = "Film \"{$judul}\" berhasil ditambahkan ke daftar!";
    } else {
        $pesanError = "ID dan Judul film wajib diisi.";
    }
}

$daftarFilm = unserialize($_SESSION['daftar_film']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Film Bioskop - TP2 DPBO</title>
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent: #38bdf8;
            --accent-hover: #0284c7;
            --border: #334155;
            --badge-bg: #0369a1;
            --badge-text: #e0f2fe;
            --danger: #ef4444;
            --success: #10b981;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background-color: var(--bg-primary);
            color: var(--text-main);
            padding: 30px 20px;
        }
        .container {
            max-width: 1300px;
            margin: 0 auto;
        }
        header {
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
        }
        .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
        }
        .header-actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: var(--accent);
            color: #0f172a;
        }
        .btn-primary:hover {
            background-color: var(--accent-hover);
        }
        .btn-secondary {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover {
            background-color: var(--border);
            color: var(--text-main);
        }
        .btn-danger {
            background-color: #dc2626;
            color: white;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid var(--success);
            color: #6ee7b7;
        }
        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid var(--danger);
            color: #fca5a5;
        }
        .layout-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 25px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }
        }
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
        }
        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .form-group {
            margin-bottom: 12px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 4px;
        }
        .form-control {
            width: 100%;
            padding: 8px 12px;
            background: #0f172a;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: white;
            font-size: 13px;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .table-responsive {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-card);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            text-align: left;
        }
        thead th {
            background-color: #0b1329;
            color: var(--accent);
            padding: 12px 14px;
            font-weight: 600;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #223249;
            vertical-align: middle;
        }
        tbody tr:hover {
            background-color: rgba(56, 189, 248, 0.04);
        }
        .poster-img {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--border);
            background: #0b1329;
            display: block;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            background-color: var(--badge-bg);
            color: var(--badge-text);
        }
        .badge-age {
            background-color: #475569;
            color: #f1f5f9;
        }
        .price {
            font-weight: 600;
            color: #38bdf8;
        }
        .meta-hierarchy {
            background: #09101f;
            border: 1px solid #1e293b;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 20px;
            font-size: 12px;
            color: var(--text-muted);
        }
        .meta-hierarchy code {
            color: var(--accent);
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div>
            <h1>Sistem Manajemen Film Bioskop</h1>
            <div class="subtitle">TP2 DPBO 2026 - Multilevel Inheritance (Media &rarr; Film &rarr; FilmBioskop)</div>
        </div>
        <div class="header-actions">
            <a href="index.php?action=reset" class="btn btn-secondary" onclick="return confirm('Reset daftar ke 5 film awal?')">Reset ke 5 Data Awal</a>
        </div>
    </header>

    <div class="meta-hierarchy">
        <strong>Struktur Pewarisan Bertingkat (Multilevel Inheritance):</strong><br>
        <code>Media</code> (id, judul, tahunRilis) &rarr;
        <code>Film</code> (sutradara, genre, durasi) &rarr;
        <code>FilmBioskop</code> (studioProduksi, ratingUsia, hargaTiket, fotoProduk)
    </div>

    <?php if (!empty($pesanSukses)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($pesanSukses) ?></div>
    <?php endif; ?>
    <?php if (!empty($pesanError)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($pesanError) ?></div>
    <?php endif; ?>

    <div class="layout-grid">
        <!-- Form Tambah Film (Add Saja) -->
        <div class="card">
            <div class="card-title">
                <span>Tambah Film Bioskop</span>
                <span class="badge">Input User</span>
            </div>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label>ID Media</label>
                        <input type="text" name="id" class="form-control" placeholder="Contoh: FB06" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Rilis</label>
                        <input type="number" name="tahunRilis" class="form-control" placeholder="2024" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Judul Film</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul film bioskop" required>
                </div>

                <div class="form-group">
                    <label>Sutradara</label>
                    <input type="text" name="sutradara" class="form-control" placeholder="Nama sutradara" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Genre</label>
                        <input type="text" name="genre" class="form-control" placeholder="Action / Sci-Fi" required>
                    </div>
                    <div class="form-group">
                        <label>Durasi (Menit)</label>
                        <input type="number" name="durasi" class="form-control" placeholder="166" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Studio Produksi</label>
                    <input type="text" name="studioProduksi" class="form-control" placeholder="Warner Bros" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Rating Usia</label>
                        <input type="text" name="ratingUsia" class="form-control" placeholder="13+" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Tiket (Rp)</label>
                        <input type="number" name="hargaTiket" class="form-control" placeholder="60000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto Produk / Poster (Khusus PHP)</label>
                    <input type="file" name="foto_produk" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Atau Nama File Gambar di image/</label>
                    <input type="text" name="foto_custom" class="form-control" value="dune_part_two.jpg">
                </div>

                <button type="submit" name="tambah_film" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                    + Tambah Film ke Tabel
                </button>
            </form>
        </div>

        <!-- Tabel Lengkap Seluruh Data dari Setiap Class -->
        <div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No / ID</th>
                            <th>Poster</th>
                            <th>Judul Film</th>
                            <th>Tahun</th>
                            <th>Sutradara</th>
                            <th>Genre</th>
                            <th>Durasi</th>
                            <th>Studio</th>
                            <th>Rating</th>
                            <th>Harga Tiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarFilm)): ?>
                            <tr>
                                <td colspan="10" style="text-align: center; color: var(--text-muted); padding: 30px;">
                                    Belum ada data film.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftarFilm as $f): ?>
                                <tr>
                                    <td><code><?= htmlspecialchars($f->getId()) ?></code></td>
                                    <td>
                                        <?php 
                                            $imgPath = "image/" . $f->getFotoProduk();
                                            if (!file_exists(__DIR__ . "/" . $imgPath) || empty($f->getFotoProduk())) {
                                                $imgPath = "image/dune_part_two.jpg";
                                            }
                                        ?>
                                        <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($f->getJudul()) ?>" class="poster-img">
                                    </td>
                                    <td><strong><?= htmlspecialchars($f->getJudul()) ?></strong></td>
                                    <td><?= htmlspecialchars($f->getTahunRilis()) ?></td>
                                    <td><?= htmlspecialchars($f->getSutradara()) ?></td>
                                    <td><span class="badge"><?= htmlspecialchars($f->getGenre()) ?></span></td>
                                    <td><?= htmlspecialchars($f->getDurasi()) ?> mnt</td>
                                    <td><?= htmlspecialchars($f->getStudioProduksi()) ?></td>
                                    <td><span class="badge badge-age"><?= htmlspecialchars($f->getRatingUsia()) ?></span></td>
                                    <td class="price">Rp <?= number_format($f->getHargaTiket(), 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div style="font-size: 12px; color: var(--text-muted); margin-top: 10px; text-align: right;">
                Total Data: <?= count($daftarFilm) ?> film ditampilkan secara lengkap dalam satu tabel.
            </div>
        </div>
    </div>
</div>

</body>
</html>
