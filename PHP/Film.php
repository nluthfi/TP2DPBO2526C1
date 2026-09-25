<?php
require_once "Media.php";

// Subclass Level 1: Film
// Mewarisi Media, menambahkan atribut spesifik karya film
class Film extends Media {
    protected string $sutradara;
    protected string $genre;
    protected int $durasi; // Dalam menit

    public function __construct(
        string $id = "",
        string $judul = "",
        int $tahunRilis = 0,
        string $sutradara = "",
        string $genre = "",
        int $durasi = 0
    ) {
        parent::__construct($id, $judul, $tahunRilis);
        $this->sutradara = $sutradara;
        $this->genre = $genre;
        $this->durasi = $durasi;
    }

    // Getter & Setter Sutradara
    public function getSutradara(): string {
        return $this->sutradara;
    }
    public function setSutradara(string $sutradara): void {
        $this->sutradara = $sutradara;
    }

    // Getter & Setter Genre
    public function getGenre(): string {
        return $this->genre;
    }
    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    // Getter & Setter Durasi
    public function getDurasi(): int {
        return $this->durasi;
    }
    public function setDurasi(int $durasi): void {
        $this->durasi = $durasi;
    }
}
?>
