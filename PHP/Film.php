<?php
require_once 'Media.php';

// Subclass Level 1: Film (mewarisi Media)
// Menambahkan atribut spesifik karya perfilman
class Film extends Media {
    protected string $sutradara;
    protected string $genre;
    protected int $durasi; // dalam menit

    public function __construct(
        string $idMedia = "",
        string $judul = "",
        int $tahunRilis = 0,
        string $sutradara = "",
        string $genre = "",
        int $durasi = 0
    ) {
        parent::__construct($idMedia, $judul, $tahunRilis);
        $this->sutradara = $sutradara;
        $this->genre = $genre;
        $this->durasi = $durasi;
    }

    // Setter
    public function setSutradara(string $sutradara): void {
        $this->sutradara = $sutradara;
    }
    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }
    public function setDurasi(int $durasi): void {
        $this->durasi = $durasi;
    }

    // Getter
    public function getSutradara(): string {
        return $this->sutradara;
    }
    public function getGenre(): string {
        return $this->genre;
    }
    public function getDurasi(): int {
        return $this->durasi;
    }

    // Prosedur menampilkan data
    public function tampilkanData(): void {
        parent::tampilkanData();
        echo "Sutradara   : " . $this->getSutradara() . "<br>";
        echo "Genre       : " . $this->getGenre() . "<br>";
        echo "Durasi      : " . $this->getDurasi() . " menit<br>";
    }
}
?>
