<?php
// Base Class: Media
// Merepresentasikan data umum karya media digital
class Media {
    protected string $id;
    protected string $judul;
    protected int $tahunRilis;

    public function __construct(string $id = "", string $judul = "", int $tahunRilis = 0) {
        $this->id = $id;
        $this->judul = $judul;
        $this->tahunRilis = $tahunRilis;
    }

    // Getter & Setter ID
    public function getId(): string {
        return $this->id;
    }
    public function setId(string $id): void {
        $this->id = $id;
    }

    // Getter & Setter Judul
    public function getJudul(): string {
        return $this->judul;
    }
    public function setJudul(string $judul): void {
        $this->judul = $judul;
    }

    // Getter & Setter Tahun Rilis
    public function getTahunRilis(): int {
        return $this->tahunRilis;
    }
    public function setTahunRilis(int $tahunRilis): void {
        $this->tahunRilis = $tahunRilis;
    }
}
?>
