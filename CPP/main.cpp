#include <iostream>
#include <vector>
#include <string>
#include <iomanip>
#include <algorithm>
#include "FilmBioskop.hpp"

using namespace std;

// Fungsi pembantu untuk membuat garis horizontal tabel dinamis
string buatGaris(const vector<int>& lebarKolom) {
    string garis = "+";
    for (int l : lebarKolom) {
        garis += string(l + 2, '-') + "+";
    }
    return garis;
}

// Fungsi untuk menampilkan seluruh data dalam satu tabel dinamis
void tampilkanTabel(const vector<FilmBioskop>& daftar, const string& judulTabel) {
    cout << "\n" << judulTabel << "\n";

    if (daftar.empty()) {
        cout << "Tidak ada data untuk ditampilkan.\n";
        return;
    }

    vector<string> headers = {
        "ID", "Judul", "Tahun", "Sutradara", "Genre",
        "Durasi", "Studio Produksi", "Rating Usia", "Harga Tiket"
    };

    int nKolom = headers.size();
    vector<int> lebar(nKolom, 0);

    for (int i = 0; i < nKolom; i++) {
        lebar[i] = headers[i].length();
    }

    // Siapkan matriks string dari setiap objek
    vector<vector<string>> barisData;
    for (const auto& f : daftar) {
        vector<string> baris = {
            f.getId(),
            f.getJudul(),
            to_string(f.getTahunRilis()),
            f.getSutradara(),
            f.getGenre(),
            to_string(f.getDurasi()) + " mnt",
            f.getStudioProduksi(),
            f.getRatingUsia(),
            "Rp " + to_string(f.getHargaTiket())
        };

        for (int i = 0; i < nKolom; i++) {
            if ((int)baris[i].length() > lebar[i]) {
                lebar[i] = baris[i].length();
            }
        }
        barisData.push_back(baris);
    }

    string garis = buatGaris(lebar);

    // Cetak garis atas
    cout << garis << "\n";

    // Cetak Header
    cout << "|";
    for (int i = 0; i < nKolom; i++) {
        cout << " " << left << setw(lebar[i]) << headers[i] << " |";
    }
    cout << "\n";

    // Cetak pembatas header
    cout << garis << "\n";

    // Cetak Baris Data
    for (const auto& baris : barisData) {
        cout << "|";
        for (int i = 0; i < nKolom; i++) {
            cout << " " << left << setw(lebar[i]) << baris[i] << " |";
        }
        cout << "\n";
    }

    // Cetak garis penutup
    cout << garis << "\n";
}

int main() {
    // 5 Objek Awal (sebelum ada input user)
    vector<FilmBioskop> daftarFilm = {
        FilmBioskop("FB01", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000),
        FilmBioskop("FB02", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000),
        FilmBioskop("FB03", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000),
        FilmBioskop("FB04", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000),
        FilmBioskop("FB05", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000)
    };

    // Tampilkan data awal
    tampilkanTabel(daftarFilm, "=== DATA AWAL FILM BIOSKOP (5 OBJEK) ===");

    // Input penambahan data dari user
    cout << "\nMasukkan jumlah film yang ingin ditambahkan: ";
    int n;
    if (!(cin >> n)) {
        return 0;
    }

    string dummy;
    getline(cin, dummy); // Membersihkan newline buffer

    for (int i = 1; i <= n; i++) {
        cout << "\n--- Input Data Film ke-" << i << " ---\n";
        string id, judul, sutradara, genre, studio, rating;
        int tahun, durasi, harga;

        cout << "ID Media            : ";
        getline(cin, id);

        cout << "Judul Film          : ";
        getline(cin, judul);

        cout << "Tahun Rilis         : ";
        cin >> tahun;
        getline(cin, dummy);

        cout << "Sutradara           : ";
        getline(cin, sutradara);

        cout << "Genre               : ";
        getline(cin, genre);

        cout << "Durasi (menit)      : ";
        cin >> durasi;
        getline(cin, dummy);

        cout << "Studio Produksi     : ";
        getline(cin, studio);

        cout << "Rating Usia         : ";
        getline(cin, rating);

        cout << "Harga Tiket (Rp)    : ";
        cin >> harga;
        getline(cin, dummy);

        // Instansiasi objek dan masukkan ke daftar
        FilmBioskop filmBaru(id, judul, tahun, sutradara, genre, durasi, studio, rating, harga);
        daftarFilm.push_back(filmBaru);
        cout << "Data film \"" << judul << "\" berhasil ditambahkan!\n";
    }

    // Tampilkan tabel akhir setelah penambahan data
    tampilkanTabel(daftarFilm, "=== DATA SELURUH FILM BIOSKOP SETELAH PENAMBAHAN ===");

    return 0;
}
