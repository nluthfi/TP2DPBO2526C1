#ifndef MEDIA_HPP
#define MEDIA_HPP

#include <string>

using namespace std;

// Base Class: Media
// Merepresentasikan data umum dari suatu karya media digital
class Media {
protected:
    string id;
    string judul;
    int tahunRilis;

public:
    // Constructor default
    Media() {
        this->id = "";
        this->judul = "";
        this->tahunRilis = 0;
    }

    // Constructor dengan parameter
    Media(string id, string judul, int tahunRilis) {
        this->id = id;
        this->judul = judul;
        this->tahunRilis = tahunRilis;
    }

    // Getter & Setter untuk ID
    string getId() const {
        return id;
    }
    void setId(string id) {
        this->id = id;
    }

    // Getter & Setter untuk Judul
    string getJudul() const {
        return judul;
    }
    void setJudul(string judul) {
        this->judul = judul;
    }

    // Getter & Setter untuk Tahun Rilis
    int getTahunRilis() const {
        return tahunRilis;
    }
    void setTahunRilis(int tahunRilis) {
        this->tahunRilis = tahunRilis;
    }

    // Destructor virtual
    virtual ~Media() {}
};

#endif
