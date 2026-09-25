// Subclass Level 1: Film (mewarisi Media)
// Menambahkan atribut spesifik karya perfilman
public class Film extends Media {
    protected String sutradara;
    protected String genre;
    protected int durasi; // dalam menit

    // Constructor default
    public Film() {
        super();
        this.sutradara = "";
        this.genre = "";
        this.durasi = 0;
    }

    // Constructor dengan parameter
    public Film(String idMedia, String judul, int tahunRilis,
                String sutradara, String genre, int durasi) {
        super(idMedia, judul, tahunRilis);
        this.sutradara = sutradara;
        this.genre = genre;
        this.durasi = durasi;
    }

    // Setter
    public void setSutradara(String sutradara) {
        this.sutradara = sutradara;
    }
    public void setGenre(String genre) {
        this.genre = genre;
    }
    public void setDurasi(int durasi) {
        this.durasi = durasi;
    }

    // Getter
    public String getSutradara() {
        return sutradara;
    }
    public String getGenre() {
        return genre;
    }
    public int getDurasi() {
        return durasi;
    }

    // Prosedur menampilkan data
    @Override
    public void tampilkanData() {
        super.tampilkanData();
        System.out.println("Sutradara   : " + getSutradara());
        System.out.println("Genre       : " + getGenre());
        System.out.println("Durasi      : " + getDurasi() + " menit");
    }
}
