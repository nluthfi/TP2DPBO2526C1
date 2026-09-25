<?php
// Base Class: Media
// Merepresentasikan data umum karya media digital
class Media {
    protected string $idMedia;
    protected string $judul;
    protected int $tahunRilis;

    public function __construct(string $idMedia = "", string $judul = "", int $tahunRilis = 0) {
        $this->idMedia = $idMedia;
        $this->judul = $judul;
        $this->tahunRilis = $tahunRilis;
    }

    // Setter
    public function setIdMedia(string $idMedia): void {
        $this->idMedia = $idMedia;
    }
    public function setJudul(string $judul): void {
        $this->judul = $judul;
    }
    public function setTahunRilis(int $tahunRilis): void {
        $this->tahunRilis = $tahunRilis;
    }

    // Getter
    public function getIdMedia(): string {
        return $this->idMedia;
    }
    public function getJudul(): string {
        return $this->judul;
    }
    public function getTahunRilis(): int {
        return $this->tahunRilis;
    }

    // Prosedur menampilkan data
    public function tampilkanData(): void {
        echo "ID Media    : " . $this->getIdMedia() . "<br>";
        echo "Judul       : " . $this->getJudul() . "<br>";
        echo "Tahun Rilis : " . $this->getTahunRilis() . "<br>";
    }
}
?>
