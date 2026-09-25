<?php
require_once 'Film.php';

// Subclass Level 2 (Multilevel Inheritance): FilmBioskop (mewarisi Film)
// Menambahkan atribut spesifik penayangan bioskop + atribut gambar/foto_produk khusus PHP
class FilmBioskop extends Film {
    private string $studioProduksi;
    private string $ratingUsia;
    private float $hargaTiket;
    private string $gambar; // Khusus bahasa PHP (path file poster film)

    public function __construct(
        string $idMedia = "",
        string $judul = "",
        int $tahunRilis = 0,
        string $sutradara = "",
        string $genre = "",
        int $durasi = 0,
        string $studioProduksi = "",
        string $ratingUsia = "",
        float $hargaTiket = 0.0,
        string $gambar = ""
    ) {
        parent::__construct($idMedia, $judul, $tahunRilis, $sutradara, $genre, $durasi);
        $this->studioProduksi = $studioProduksi;
        $this->ratingUsia = $ratingUsia;
        $this->hargaTiket = $hargaTiket;
        $this->gambar = $gambar;
    }

    // Setter
    public function setStudioProduksi(string $studio): void {
        $this->studioProduksi = $studio;
    }
    public function setRatingUsia(string $rating): void {
        $this->ratingUsia = $rating;
    }
    public function setHargaTiket(float $harga): void {
        $this->hargaTiket = $harga;
    }
    public function setGambar(string $gambar): void {
        $this->gambar = $gambar;
    }

    // Getter
    public function getStudioProduksi(): string {
        return $this->studioProduksi;
    }
    public function getRatingUsia(): string {
        return $this->ratingUsia;
    }
    public function getHargaTiket(): float {
        return $this->hargaTiket;
    }
    public function getGambar(): string {
        return $this->gambar;
    }

    // Prosedur menampilkan data
    public function tampilkanData(): void {
        parent::tampilkanData();
        echo "Studio      : " . $this->getStudioProduksi() . "<br>";
        echo "Rating Usia : " . $this->getRatingUsia() . "<br>";
        echo "Harga Tiket : Rp" . number_format($this->getHargaTiket(), 0, ',', '.') . "<br>";
        echo "Gambar      : " . $this->getGambar() . "<br>";
    }
}
?>
