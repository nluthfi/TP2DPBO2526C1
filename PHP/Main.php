<?php
require_once 'FilmBioskop.php';

// Inisialisasi 5 objek awal
function getInitialFilmList(): array {
    return [
        new FilmBioskop('FB001', 'Avengers: Endgame', 2019, 'Anthony Russo', 'Action / Sci-Fi', 181, 'Marvel Studios', '13+', 55000, './images/avengers_endgame.jpg'),
        new FilmBioskop('FB002', 'Interstellar', 2014, 'Christopher Nolan', 'Sci-Fi / Adventure', 169, 'Paramount Pictures', '13+', 50000, './images/interstellar.jpg'),
        new FilmBioskop('FB003', 'Spider-Man: No Way Home', 2021, 'Jon Watts', 'Action / Adventure', 148, 'Columbia Pictures', '13+', 50000, './images/spiderman_brand_new_day.jpg'),
        new FilmBioskop('FB004', 'Thor: Ragnarok', 2017, 'Taika Waititi', 'Action / Comedy', 130, 'Marvel Studios', '13+', 45000, './images/thor_ragnarok.jpg'),
        new FilmBioskop('FB005', 'Oppenheimer', 2023, 'Christopher Nolan', 'Biography / Drama', 180, 'Universal Pictures', '17+', 60000, './images/oppenheimer.jpg')
    ];
}

// Terminal
if (php_sapi_name() === 'cli') {
    $daftarFilm = getInitialFilmList();

    function isIdExistsCli($id, $list) {
        foreach ($list as $f) {
            if (strcasecmp($f->getIdMedia(), $id) === 0) return true;
        }
        return false;
    }

    function printTableCli($list) {
        if (empty($list)) {
            echo "\nBelum ada data film bioskop.\n";
            return;
        }
        $headers = ["ID", "Judul", "Tahun", "Sutradara", "Genre", "Durasi", "Studio", "Rating", "Harga", "Gambar"];
        $w = array_map('strlen', $headers);

        $rows = [];
        foreach ($list as $f) {
            $row = [
                $f->getIdMedia(),
                $f->getJudul(),
                (string)$f->getTahunRilis(),
                $f->getSutradara(),
                $f->getGenre(),
                $f->getDurasi() . " menit",
                $f->getStudioProduksi(),
                $f->getRatingUsia(),
                "Rp" . (int)$f->getHargaTiket(),
                $f->getGambar()
            ];
            for ($i = 0; $i < count($headers); $i++) {
                if (strlen($row[$i]) > $w[$i]) $w[$i] = strlen($row[$i]);
            }
            $rows[] = $row;
        }

        $sep = "+";
        foreach ($w as $colW) $sep .= str_repeat("-", $colW + 2) . "+";

        echo "\n=== DAFTAR FILM BIOSKOP ===\n" . $sep . "\n|";
        for ($i = 0; $i < count($headers); $i++) {
            echo " " . str_pad($headers[$i], $w[$i]) . " |";
        }
        echo "\n" . $sep . "\n";

        foreach ($rows as $r) {
            echo "|";
            for ($i = 0; $i < count($headers); $i++) {
                echo " " . str_pad($r[$i], $w[$i]) . " |";
            }
            echo "\n";
        }
        echo $sep . "\n";
    }

    while (true) {
        echo "\n=== MENU BIOSKOP ===\n";
        echo "1. Tampilkan Daftar Film\n";
        echo "2. Tambah Film Bioskop Baru\n";
        echo "3. Keluar\n";
        echo "Pilih menu: ";

        $pilihanStr = trim(fgets(STDIN));
        if ($pilihanStr === "" || !is_numeric($pilihanStr)) break;
        $pilihan = (int)$pilihanStr;

        if ($pilihan === 1) {
            printTableCli($daftarFilm);
        } elseif ($pilihan === 2) {
            echo "\nMasukkan data film bioskop baru:\n";
            while (true) {
                echo "ID Media            : ";
                $id = trim(fgets(STDIN));
                if (isIdExistsCli($id, $daftarFilm)) {
                    echo "ID ini sudah ada. Silakan masukkan ID lain.\n";
                    continue;
                }
                break;
            }

            echo "Judul Film          : "; $judul = trim(fgets(STDIN));
            echo "Tahun Rilis         : "; $tahun = (int)trim(fgets(STDIN));
            echo "Sutradara           : "; $sutradara = trim(fgets(STDIN));
            echo "Genre               : "; $genre = trim(fgets(STDIN));
            echo "Durasi (menit)      : "; $durasi = (int)trim(fgets(STDIN));
            echo "Studio Produksi     : "; $studio = trim(fgets(STDIN));
            echo "Rating Usia         : "; $rating = trim(fgets(STDIN));
            echo "Harga Tiket (Rp)    : "; $harga = (double)trim(fgets(STDIN));
            $gambar = "./images/dune_part_two.jpg";

            $daftarFilm[] = new FilmBioskop($id, $judul, $tahun, $sutradara, $genre, $durasi, $studio, $rating, $harga, $gambar);
            echo "\n✅ Film \"{$judul}\" berhasil ditambahkan!\n";
        } elseif ($pilihan === 3) {
            break;
        }
    }
    echo "\nTerima kasih sudah menggunakan sistem bioskop!\n";
    exit(0);
}

// WEB
session_start();

// Reset data SESSION
if (isset($_POST['reset_data'])) {
    session_unset();
    session_destroy();
    header("Location: Main.php");
    exit();
}

// Inisialisasi session dengan 5 data awal
if (!isset($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = serialize(getInitialFilmList());
}

$message = '';
$message_type = '';

function isIdExistsWeb($id, $list) {
    foreach ($list as $item) {
        if (strcasecmp($item->getIdMedia(), $id) === 0) {
            return true;
        }
    }
    return false;
}

// Logika Tambah Data (Add Saja)
if (isset($_POST['tambah'])) {
    $daftarFilm = unserialize($_SESSION['daftarFilm']);

    $idMedia        = trim($_POST['idMedia'] ?? '');
    $judul          = trim($_POST['judul'] ?? '');
    $tahunRilis     = filter_input(INPUT_POST, 'tahunRilis', FILTER_VALIDATE_INT);
    $sutradara      = trim($_POST['sutradara'] ?? '');
    $genre          = trim($_POST['genre'] ?? '');
    $durasi         = filter_input(INPUT_POST, 'durasi', FILTER_VALIDATE_INT);
    $studioProduksi = trim($_POST['studioProduksi'] ?? '');
    $ratingUsia     = trim($_POST['ratingUsia'] ?? '');
    $hargaTiket     = filter_input(INPUT_POST, 'hargaTiket', FILTER_VALIDATE_FLOAT);
    $gambar         = './images/dune_part_two.jpg';

    // Validasi input
    if (empty($idMedia) || empty($judul) || empty($sutradara) || empty($genre) || empty($studioProduksi) || empty($ratingUsia)) {
        $message = "Semua bidang teks wajib diisi!";
        $message_type = "danger";
    } elseif (isIdExistsWeb($idMedia, $daftarFilm)) {
        $message = "ID Media '{$idMedia}' sudah terdaftar! Gunakan ID lain.";
        $message_type = "danger";
    } elseif ($tahunRilis === false || $tahunRilis < 1888) {
        $message = "Tahun rilis tidak valid!";
        $message_type = "danger";
    } elseif ($durasi === false || $durasi <= 0) {
        $message = "Durasi harus berupa angka positif (menit)!";
        $message_type = "danger";
    } elseif ($hargaTiket === false || $hargaTiket <= 0) {
        $message = "Harga tiket harus berupa angka positif!";
        $message_type = "danger";
    } else {
        // Upload gambar jika ada
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . "/images/";
            $fileName = basename($_FILES['gambar']['name']);
            $targetFilePath = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
                $gambar = './images/' . $fileName;
            }
        } elseif (!empty($_POST['gambar_custom'])) {
            $gambar = './images/' . trim($_POST['gambar_custom']);
        }

        $daftarFilm[] = new FilmBioskop($idMedia, $judul, $tahunRilis, $sutradara, $genre, $durasi, $studioProduksi, $ratingUsia, $hargaTiket, $gambar);
        $_SESSION['daftarFilm'] = serialize($daftarFilm);
        $message = "Film '{$judul}' berhasil ditambahkan ke daftar!";
        $message_type = "success";
    }
}

$daftarFilm = unserialize($_SESSION['daftarFilm']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Film Bioskop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen py-10 px-4 md:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Sistem Manajemen Film Bioskop</h1>
                <p class="text-xs text-slate-500 mt-1">Platform pendataan & katalog film bioskop</p>
            </div>
            <form method="POST" onsubmit="return confirm('Kembalikan ke 5 data default awal?');">
                <button type="submit" name="reset_data" class="bg-rose-600 hover:bg-rose-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm">
                    Reset ke 5 Data Awal
                </button>
            </form>
        </div>

        <!-- Alert -->
        <?php if (!empty($message)): ?>
            <div class="p-4 mb-6 rounded-lg text-sm font-medium <?= $message_type === 'danger' ? 'bg-red-50 border border-red-200 text-red-700' : 'bg-emerald-50 border border-emerald-200 text-emerald-800' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <!-- Form Tambah Film -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center justify-between">
                    <span>Tambah Film Baru</span>
                    <span class="text-xs bg-sky-50 text-sky-700 border border-sky-200 px-2 py-1 rounded font-medium">Input User</span>
                </h2>
                <form method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">ID Media</label>
                            <input type="text" name="idMedia" required placeholder="FB006" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Tahun Rilis</label>
                            <input type="number" name="tahunRilis" required placeholder="2024" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Judul Film</label>
                        <input type="text" name="judul" required placeholder="Dune: Part Two" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Sutradara</label>
                        <input type="text" name="sutradara" required placeholder="Denis Villeneuve" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Genre</label>
                            <input type="text" name="genre" required placeholder="Sci-Fi / Adventure" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Durasi (Menit)</label>
                            <input type="number" name="durasi" required placeholder="166" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Studio Produksi</label>
                        <input type="text" name="studioProduksi" required placeholder="Warner Bros" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-400 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Rating Usia</label>
                            <input type="text" name="ratingUsia" required placeholder="13+" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Harga Tiket (Rp)</label>
                            <input type="number" name="hargaTiket" required placeholder="60000" class="w-full bg-white border border-slate-300 rounded px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-400 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Gambar Poster (Khusus PHP)</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs text-slate-600 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-sky-100 file:text-sky-700 hover:file:bg-sky-200">
                    </div>

                    <button type="submit" name="tambah" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-2.5 rounded-lg transition shadow mt-2">
                        + Tambah Film
                    </button>
                </form>
            </div>

            <!-- Tabel Data Film -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-6 shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Daftar Film Bioskop</h2>
                    <div class="overflow-x-auto rounded-lg border border-slate-200">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead class="bg-slate-100 text-slate-700 border-b border-slate-200 font-semibold">
                                <tr>
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Poster</th>
                                    <th class="p-3">Judul Film</th>
                                    <th class="p-3">Tahun</th>
                                    <th class="p-3">Sutradara</th>
                                    <th class="p-3">Genre</th>
                                    <th class="p-3">Durasi</th>
                                    <th class="p-3">Studio</th>
                                    <th class="p-3">Rating</th>
                                    <th class="p-3">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <?php foreach ($daftarFilm as $f): ?>
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="p-3 font-mono font-medium text-sky-700"><?= htmlspecialchars($f->getIdMedia()) ?></td>
                                        <td class="p-3">
                                            <img src="<?= htmlspecialchars($f->getGambar()) ?>" alt="<?= htmlspecialchars($f->getJudul()) ?>" class="w-10 h-14 object-cover rounded shadow-sm border border-slate-200 bg-slate-100">
                                        </td>
                                        <td class="p-3 font-semibold text-slate-900"><?= htmlspecialchars($f->getJudul()) ?></td>
                                        <td class="p-3 text-slate-600"><?= htmlspecialchars($f->getTahunRilis()) ?></td>
                                        <td class="p-3 text-slate-600"><?= htmlspecialchars($f->getSutradara()) ?></td>
                                        <td class="p-3"><span class="bg-sky-50 text-sky-700 border border-sky-200 px-2 py-0.5 rounded text-[11px] font-medium"><?= htmlspecialchars($f->getGenre()) ?></span></td>
                                        <td class="p-3 text-slate-600"><?= htmlspecialchars($f->getDurasi()) ?> menit</td>
                                        <td class="p-3 text-slate-600"><?= htmlspecialchars($f->getStudioProduksi()) ?></td>
                                        <td class="p-3"><span class="bg-slate-100 text-slate-700 border border-slate-200 px-2 py-0.5 rounded text-[11px] font-medium"><?= htmlspecialchars($f->getRatingUsia()) ?></span></td>
                                        <td class="p-3 font-semibold text-sky-700">Rp<?= number_format($f->getHargaTiket(), 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right text-xs text-slate-500 mt-4">
                    Menampilkan total <?= count($daftarFilm) ?> film bioskop.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
