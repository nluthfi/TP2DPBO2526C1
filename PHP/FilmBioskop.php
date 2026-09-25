<?php
require_once "Film.php";

// Subclass Level 2 (Multilevel Inheritance): FilmBioskop
// Mewarisi Film (yang mewarisi Media)
// Menambahkan atribut spesifik penayangan bioskop + atribut foto_produk khusus PHP
class FilmBioskop extends Film {
    private string $studioProduksi;
    private string $ratingUsia;
    private int $hargaTiket;
    private string $fotoProduk; // Khusus bahasa PHP (path file poster)

    public function __construct(
        string $id = "",
        string $judul = "",
        int $tahunRilis = 0,
        string $sutradara = "",
        string $genre = "",
        int $durasi = 0,
        string $studioProduksi = "",
        string $ratingUsia = "",
        int $hargaTiket = 0,
        string $fotoProduk = ""
    ) {
        parent::__construct($id, $judul, $tahunRilis, $sutradara, $genre, $durasi);
        $this->studioProduksi = $studioProduksi;
        $this->ratingUsia = $ratingUsia;
        $this->hargaTiket = $hargaTiket;
        $this->fotoProduk = $fotoProduk;
    }

    // Getter & Setter Studio Produksi
    public function getStudioProduksi(): string {
        return $this->studioProduksi;
    }
    public function setStudioProduksi(string $studioProduksi): void {
        $this->studioProduksi = $studioProduksi;
    }

    // Getter & Setter Rating Usia
    public function getRatingUsia(): string {
        return $this->ratingUsia;
    }
    public function setRatingUsia(string $ratingUsia): void {
        $this->ratingUsia = $ratingUsia;
    }

    // Getter & Setter Harga Tiket
    public function getHargaTiket(): int {
        return $this->hargaTiket;
    }
    public function setHargaTiket(int $hargaTiket): void {
        $this->hargaTiket = $hargaTiket;
    }

    // Getter & Setter Foto Produk (Khusus PHP)
    public function getFotoProduk(): string {
        return $this->fotoProduk;
    }
    public function setFotoProduk(string $fotoProduk): void {
        $this->fotoProduk = $fotoProduk;
    }
}
?>
