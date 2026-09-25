#ifndef FILM_HPP
#define FILM_HPP

#include "Media.hpp"
#include <string>

using namespace std;

// Subclass Level 1: Film
// Mewarisi Media, menambahkan atribut spesifik karya film
class Film : public Media {
protected:
    string sutradara;
    string genre;
    int durasi; // Dalam menit

public:
    // Constructor default
    Film() : Media() {
        this->sutradara = "";
        this->genre = "";
        this->durasi = 0;
    }

    // Constructor dengan parameter (memanggil constructor Media)
    Film(string id, string judul, int tahunRilis,
         string sutradara, string genre, int durasi)
        : Media(id, judul, tahunRilis) {
        this->sutradara = sutradara;
        this->genre = genre;
        this->durasi = durasi;
    }

    // Getter & Setter untuk Sutradara
    string getSutradara() const {
        return sutradara;
    }
    void setSutradara(string sutradara) {
        this->sutradara = sutradara;
    }

    // Getter & Setter untuk Genre
    string getGenre() const {
        return genre;
    }
    void setGenre(string genre) {
        this->genre = genre;
    }

    // Getter & Setter untuk Durasi
    int getDurasi() const {
        return durasi;
    }
    void setDurasi(int durasi) {
        this->durasi = durasi;
    }

    virtual ~Film() {}
};

#endif
