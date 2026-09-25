// Subclass Level 1: Film
// Mewarisi Media, menambahkan atribut spesifik karya film
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

    // Constructor dengan parameter (memanggil super constructor)
    public Film(String id, String judul, int tahunRilis,
                String sutradara, String genre, int durasi) {
        super(id, judul, tahunRilis);
        this.sutradara = sutradara;
        this.genre = genre;
        this.durasi = durasi;
    }

    // Getter & Setter untuk Sutradara
    public String getSutradara() {
        return sutradara;
    }
    public void setSutradara(String sutradara) {
        this.sutradara = sutradara;
    }

    // Getter & Setter untuk Genre
    public String getGenre() {
        return genre;
    }
    public void setGenre(String genre) {
        this.genre = genre;
    }

    // Getter & Setter untuk Durasi
    public int getDurasi() {
        return durasi;
    }
    public void setDurasi(int durasi) {
        this.durasi = durasi;
    }
}
