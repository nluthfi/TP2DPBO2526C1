#ifndef MEDIA_CPP
#define MEDIA_CPP

#include <iostream>
#include <string>

using namespace std;

// Base Class: Media
// Merepresentasikan data umum karya media digital
class Media {
protected:
    string idMedia;
    string judul;
    int tahunRilis;

public:
    // Constructor default
    Media() {
        this->idMedia = "";
        this->judul = "";
        this->tahunRilis = 0;
    }

    // Constructor dengan parameter
    Media(string idMedia, string judul, int tahunRilis) {
        this->idMedia = idMedia;
        this->judul = judul;
        this->tahunRilis = tahunRilis;
    }

    // Setter
    void setIdMedia(const string& id) {
        this->idMedia = id;
    }
    void setJudul(const string& judul) {
        this->judul = judul;
    }
    void setTahunRilis(int tahun) {
        this->tahunRilis = tahun;
    }

    // Getter
    string getIdMedia() const {
        return idMedia;
    }
    string getJudul() const {
        return judul;
    }
    int getTahunRilis() const {
        return tahunRilis;
    }

    // Prosedur menampilkan data dasar
    void tampilkanData() const {
        cout << "ID Media    : " << getIdMedia() << endl
             << "Judul       : " << getJudul() << endl
             << "Tahun Rilis : " << getTahunRilis() << endl;
    }

    virtual ~Media() {}
};

#endif
