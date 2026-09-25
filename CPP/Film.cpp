#ifndef FILM_CPP
#define FILM_CPP

#include "Media.cpp"
#include <string>

using namespace std;

// Subclass Level 1: Film (mewarisi Media)
// Menambahkan atribut spesifik karya perfilman
class Film : public Media {
protected:
    string sutradara;
    string genre;
    int durasi; // dalam menit

public:
    // Constructor default
    Film() : Media() {
        this->sutradara = "";
        this->genre = "";
        this->durasi = 0;
    }

    // Constructor dengan parameter (memanggil constructor parent)
    Film(string idMedia, string judul, int tahunRilis,
         string sutradara, string genre, int durasi)
        : Media(idMedia, judul, tahunRilis) {
        this->sutradara = sutradara;
        this->genre = genre;
        this->durasi = durasi;
    }

    // Setter
    void setSutradara(const string& sutradara) {
        this->sutradara = sutradara;
    }
    void setGenre(const string& genre) {
        this->genre = genre;
    }
    void setDurasi(int durasi) {
        this->durasi = durasi;
    }

    // Getter
    string getSutradara() const {
        return sutradara;
    }
    string getGenre() const {
        return genre;
    }
    int getDurasi() const {
        return durasi;
    }

    // Prosedur menampilkan data
    void tampilkanData() const {
        Media::tampilkanData();
        cout << "Sutradara   : " << getSutradara() << endl
             << "Genre       : " << getGenre() << endl
             << "Durasi      : " << getDurasi() << " menit" << endl;
    }

    virtual ~Film() {}
};

#endif
