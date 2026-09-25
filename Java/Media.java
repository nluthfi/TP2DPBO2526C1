// Base Class: Media
// Merepresentasikan data umum karya media
public class Media {
    protected String id;
    protected String judul;
    protected int tahunRilis;

    // Constructor default
    public Media() {
        this.id = "";
        this.judul = "";
        this.tahunRilis = 0;
    }

    // Constructor dengan parameter
    public Media(String id, String judul, int tahunRilis) {
        this.id = id;
        this.judul = judul;
        this.tahunRilis = tahunRilis;
    }

    // Getter & Setter untuk ID
    public String getId() {
        return id;
    }
    public void setId(String id) {
        this.id = id;
    }

    // Getter & Setter untuk Judul
    public String getJudul() {
        return judul;
    }
    public void setJudul(String judul) {
        this.judul = judul;
    }

    // Getter & Setter untuk Tahun Rilis
    public int getTahunRilis() {
        return tahunRilis;
    }
    public void setTahunRilis(int tahunRilis) {
        this.tahunRilis = tahunRilis;
    }
}
