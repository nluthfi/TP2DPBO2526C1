// Base Class: Media
// Merepresentasikan data umum karya media digital
public class Media {
    protected String idMedia;
    protected String judul;
    protected int tahunRilis;

    // Constructor default
    public Media() {
        this.idMedia = "";
        this.judul = "";
        this.tahunRilis = 0;
    }

    // Constructor dengan parameter
    public Media(String idMedia, String judul, int tahunRilis) {
        this.idMedia = idMedia;
        this.judul = judul;
        this.tahunRilis = tahunRilis;
    }

    // Setter
    public void setIdMedia(String idMedia) {
        this.idMedia = idMedia;
    }
    public void setJudul(String judul) {
        this.judul = judul;
    }
    public void setTahunRilis(int tahunRilis) {
        this.tahunRilis = tahunRilis;
    }

    // Getter
    public String getIdMedia() {
        return idMedia;
    }
    public String getJudul() {
        return judul;
    }
    public int getTahunRilis() {
        return tahunRilis;
    }

    // Prosedur menampilkan data
    public void tampilkanData() {
        System.out.println("ID Media    : " + getIdMedia());
        System.out.println("Judul       : " + getJudul());
        System.out.println("Tahun Rilis : " + getTahunRilis());
    }
}
