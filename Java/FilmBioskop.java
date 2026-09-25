// Subclass Level 2 (Multilevel Inheritance): FilmBioskop (mewarisi Film)
// Menambahkan atribut spesifik penayangan film di bioskop
public class FilmBioskop extends Film {
    private String studioProduksi;
    private String ratingUsia; // contoh: SU, 13+, 17+, 21+
    private double hargaTiket; // dalam Rupiah

    // Constructor default
    public FilmBioskop() {
        super();
        this.studioProduksi = "";
        this.ratingUsia = "";
        this.hargaTiket = 0.0;
    }

    // Constructor dengan parameter lengkap
    public FilmBioskop(String idMedia, String judul, int tahunRilis,
                       String sutradara, String genre, int durasi,
                       String studioProduksi, String ratingUsia, double hargaTiket) {
        super(idMedia, judul, tahunRilis, sutradara, genre, durasi);
        this.studioProduksi = studioProduksi;
        this.ratingUsia = ratingUsia;
        this.hargaTiket = hargaTiket;
    }

    // Setter
    public void setStudioProduksi(String studio) {
        this.studioProduksi = studio;
    }
    public void setRatingUsia(String rating) {
        this.ratingUsia = rating;
    }
    public void setHargaTiket(double harga) {
        this.hargaTiket = harga;
    }

    // Getter
    public String getStudioProduksi() {
        return studioProduksi;
    }
    public String getRatingUsia() {
        return ratingUsia;
    }
    public double getHargaTiket() {
        return hargaTiket;
    }

    // Prosedur menampilkan data
    @Override
    public void tampilkanData() {
        super.tampilkanData();
        System.out.println("Studio      : " + getStudioProduksi());
        System.out.println("Rating Usia : " + getRatingUsia());
        System.out.println("Harga Tiket : Rp" + (long) getHargaTiket());
    }
}
