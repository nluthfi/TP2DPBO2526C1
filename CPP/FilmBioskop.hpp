#ifndef FILM_BIOSKOP_HPP
#define FILM_BIOSKOP_HPP

#include "Film.hpp"
#include <string>

using namespace std;

// Subclass Level 2 (Multilevel Inheritance): FilmBioskop
// Mewarisi Film (yang mewarisi Media)
// Menambahkan atribut spesifik penayangan film komersial di bioskop
class FilmBioskop : public Film {
private:
    string studioProduksi;
    string ratingUsia; // contoh: SU, 13+, 17+, 21+
    int hargaTiket;    // dalam Rupiah

public:
    // Constructor default
    FilmBioskop() : Film() {
        this->studioProduksi = "";
        this->ratingUsia = "";
        this->hargaTiket = 0;
    }

    // Constructor dengan parameter lengkap
    FilmBioskop(string id, string judul, int tahunRilis,
                string sutradara, string genre, int durasi,
                string studioProduksi, string ratingUsia, int hargaTiket)
        : Film(id, judul, tahunRilis, sutradara, genre, durasi) {
        this->studioProduksi = studioProduksi;
        this->ratingUsia = ratingUsia;
        this->hargaTiket = hargaTiket;
    }

    // Getter & Setter untuk Studio Produksi
    string getStudioProduksi() const {
        return studioProduksi;
    }
    void setStudioProduksi(string studioProduksi) {
        this->studioProduksi = studioProduksi;
    }

    // Getter & Setter untuk Rating Usia
    string getRatingUsia() const {
        return ratingUsia;
    }
    void setRatingUsia(string ratingUsia) {
        this->ratingUsia = ratingUsia;
    }

    // Getter & Setter untuk Harga Tiket
    int getHargaTiket() const {
        return hargaTiket;
    }
    void setHargaTiket(int hargaTiket) {
        this->hargaTiket = hargaTiket;
    }

    virtual ~FilmBioskop() {}
};

#endif
