#ifndef FILM_BIOSKOP_CPP
#define FILM_BIOSKOP_CPP

#include "Film.cpp"
#include <string>

using namespace std;

// Subclass Level 2 (Multilevel Inheritance): FilmBioskop (mewarisi Film)
// Menambahkan atribut spesifik penayangan film komersial di bioskop
class FilmBioskop : public Film {
private:
    string studioProduksi;
    string ratingUsia; // contoh: SU, 13+, 17+, 21+
    double hargaTiket; // dalam Rupiah

public:
    // Constructor default
    FilmBioskop() : Film() {
        this->studioProduksi = "";
        this->ratingUsia = "";
        this->hargaTiket = 0.0;
    }

    // Constructor dengan parameter lengkap
    FilmBioskop(string idMedia, string judul, int tahunRilis,
                string sutradara, string genre, int durasi,
                string studioProduksi, string ratingUsia, double hargaTiket)
        : Film(idMedia, judul, tahunRilis, sutradara, genre, durasi) {
        this->studioProduksi = studioProduksi;
        this->ratingUsia = ratingUsia;
        this->hargaTiket = hargaTiket;
    }

    // Setter
    void setStudioProduksi(const string& studio) {
        this->studioProduksi = studio;
    }
    void setRatingUsia(const string& rating) {
        this->ratingUsia = rating;
    }
    void setHargaTiket(double harga) {
        this->hargaTiket = harga;
    }

    // Getter
    string getStudioProduksi() const {
        return studioProduksi;
    }
    string getRatingUsia() const {
        return ratingUsia;
    }
    double getHargaTiket() const {
        return hargaTiket;
    }

    // Prosedur menampilkan data
    void tampilkanData() const {
        Film::tampilkanData();
        cout << "Studio      : " << getStudioProduksi() << endl
             << "Rating Usia : " << getRatingUsia() << endl
             << "Harga Tiket : Rp" << (long long)getHargaTiket() << endl;
    }

    virtual ~FilmBioskop() {}
};

#endif
