// Subclass Level 2 (Multilevel Inheritance): FilmBioskop
// Mewarisi Film (yang mewarisi Media)
// Menambahkan atribut spesifik penayangan bioskop
public class FilmBioskop extends Film {
    private String studioProduksi;
    private String ratingUsia; // contoh: SU, 13+, 17+, 21+
    private int hargaTiket;    // dalam Rupiah

    // Constructor default
    public FilmBioskop() {
        super();
        this.studioProduksi = "";
        this.ratingUsia = "";
        this.hargaTiket = 0;
    }

    // Constructor dengan parameter lengkap
    public FilmBioskop(String id, String judul, int tahunRilis,
                       String sutradara, String genre, int durasi,
                       String studioProduksi, String ratingUsia, int hargaTiket) {
        super(id, judul, tahunRilis, sutradara, genre, durasi);
        this.studioProduksi = studioProduksi;
        this.ratingUsia = ratingUsia;
        this.hargaTiket = hargaTiket;
    }

    // Getter & Setter untuk Studio Produksi
    public String getStudioProduksi() {
        return studioProduksi;
    }
    public void setStudioProduksi(String studioProduksi) {
        this.studioProduksi = studioProduksi;
    }

    // Getter & Setter untuk Rating Usia
    public String getRatingUsia() {
        return ratingUsia;
    }
    public void setRatingUsia(String ratingUsia) {
        this.ratingUsia = ratingUsia;
    }

    // Getter & Setter untuk Harga Tiket
    public int getHargaTiket() {
        return hargaTiket;
    }
    public void setHargaTiket(int hargaTiket) {
        this.hargaTiket = hargaTiket;
    }
}
