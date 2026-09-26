#include "FilmBioskop.cpp"
#include <iomanip>
#include <iostream>
#include <limits>
#include <string>
#include <vector>

using namespace std;

vector<FilmBioskop> daftarFilm;

// Fungsi untuk memeriksa apakah ID sudah ada
bool isIdExists(const string &id) {
  for (const auto &f : daftarFilm) {
    if (f.getIdMedia() == id) {
      return true;
    }
  }
  return false;
}

// Fungsi cari panjang string maksimal di kolom tertentu
int maxLength(const vector<FilmBioskop> &list, const string &tipe) {
  int maks = (int)tipe.length();

  if (tipe == "Harga") {
    for (const auto &f : list) {
      string val = "Rp" + to_string((long long)f.getHargaTiket());
      if ((int)val.length() > maks)
        maks = (int)val.length();
    }
  } else if (tipe == "Durasi") {
    for (const auto &f : list) {
      string val = to_string(f.getDurasi()) + " menit";
      if ((int)val.length() > maks)
        maks = (int)val.length();
    }
  } else if (tipe == "Tahun") {
    for (const auto &f : list) {
      string val = to_string(f.getTahunRilis());
      if ((int)val.length() > maks)
        maks = (int)val.length();
    }
  } else {
    for (const auto &f : list) {
      string val = "";
      if (tipe == "ID")
        val = f.getIdMedia();
      else if (tipe == "Judul")
        val = f.getJudul();
      else if (tipe == "Sutradara")
        val = f.getSutradara();
      else if (tipe == "Genre")
        val = f.getGenre();
      else if (tipe == "Studio")
        val = f.getStudioProduksi();
      else if (tipe == "Rating")
        val = f.getRatingUsia();

      if ((int)val.length() > maks)
        maks = (int)val.length();
    }
  }
  return maks;
}

// Menampilkan seluruh data dalam format tabel dinamis
void tampilkanTabel(const vector<FilmBioskop> &list) {
  if (list.empty()) {
    cout << "\nBelum ada data film bioskop.\n";
    return;
  }

  int wId = maxLength(list, "ID") + 2;
  int wJudul = maxLength(list, "Judul") + 2;
  int wTahun = maxLength(list, "Tahun") + 2;
  int wSutradara = maxLength(list, "Sutradara") + 2;
  int wGenre = maxLength(list, "Genre") + 2;
  int wDurasi = maxLength(list, "Durasi") + 2;
  int wStudio = maxLength(list, "Studio") + 2;
  int wRating = maxLength(list, "Rating") + 2;
  int wHarga = maxLength(list, "Harga") + 2;

  string line = "+" + string(wId, '-') + "+" + string(wJudul, '-') + "+" +
                string(wTahun, '-') + "+" + string(wSutradara, '-') + "+" +
                string(wGenre, '-') + "+" + string(wDurasi, '-') + "+" +
                string(wStudio, '-') + "+" + string(wRating, '-') + "+" +
                string(wHarga, '-') + "+";

  cout << "\n=== DAFTAR FILM BIOSKOP ===\n";
  cout << line << "\n";

  cout << "|" << left << setw(wId) << " ID"
       << "|" << setw(wJudul) << " Judul"
       << "|" << setw(wTahun) << " Tahun"
       << "|" << setw(wSutradara) << " Sutradara"
       << "|" << setw(wGenre) << " Genre"
       << "|" << setw(wDurasi) << " Durasi"
       << "|" << setw(wStudio) << " Studio"
       << "|" << setw(wRating) << " Rating"
       << "|" << setw(wHarga) << " Harga" << "|\n";

  cout << line << "\n";

  for (const auto &f : list) {
    cout << "|" << left << setw(wId) << (" " + f.getIdMedia() + " ") << "|"
         << setw(wJudul) << (" " + f.getJudul() + " ") << "|" << setw(wTahun)
         << (" " + to_string(f.getTahunRilis()) + " ") << "|"
         << setw(wSutradara) << (" " + f.getSutradara() + " ") << "|"
         << setw(wGenre) << (" " + f.getGenre() + " ") << "|" << setw(wDurasi)
         << (" " + to_string(f.getDurasi()) + " menit ") << "|" << setw(wStudio)
         << (" " + f.getStudioProduksi() + " ") << "|" << setw(wRating)
         << (" " + f.getRatingUsia() + " ") << "|" << setw(wHarga)
         << (" " + ("Rp" + to_string((long long)f.getHargaTiket())) + " ")
         << "|\n";
  }

  cout << line << "\n";
}

int main() {
  // 5 Objek Awal (sebelum ada input user)
  daftarFilm.push_back(FilmBioskop("FB001", "Avengers: Endgame", 2019,
                                   "Anthony Russo", "Action / Sci-Fi", 181,
                                   "Marvel Studios", "13+", 55000));
  daftarFilm.push_back(FilmBioskop("FB002", "Interstellar", 2014,
                                   "Christopher Nolan", "Sci-Fi / Adventure",
                                   169, "Paramount Pictures", "13+", 50000));
  daftarFilm.push_back(FilmBioskop("FB003", "Spider-Man: No Way Home", 2021,
                                   "Jon Watts", "Action / Adventure", 148,
                                   "Columbia Pictures", "13+", 50000));
  daftarFilm.push_back(FilmBioskop("FB004", "Thor: Ragnarok", 2017,
                                   "Taika Waititi", "Action / Comedy", 130,
                                   "Marvel Studios", "13+", 45000));
  daftarFilm.push_back(FilmBioskop("FB005", "Oppenheimer", 2023,
                                   "Christopher Nolan", "Biography / Drama",
                                   180, "Universal Pictures", "17+", 60000));

  int pilihan;

  do {
    cout << "\n=== MENU BIOSKOP ===\n";
    cout << "1. Tampilkan Daftar Film\n";
    cout << "2. Tambah Film Bioskop Baru\n";
    cout << "3. Keluar\n";
    cout << "Pilih menu: ";

    if (!(cin >> pilihan)) {
      cin.clear();
      break;
    }

    if (pilihan == 1) {
      tampilkanTabel(daftarFilm);
    } else if (pilihan == 2) {
      string id, judul, sutradara, genre, studio, rating;
      int tahun, durasi;
      double harga;

      cout << "\nMasukkan data film bioskop baru:\n";

      // Validasi ID unik
      do {
        cout << "ID Media            : ";
        if (!(cin >> id))
          return 0;
        if (isIdExists(id)) {
          cout << "ID ini sudah ada. Silakan masukkan ID lain.\n";
        }
      } while (isIdExists(id));

      cin.ignore(numeric_limits<streamsize>::max(), '\n');

      cout << "Judul Film          : ";
      if (!getline(cin, judul))
        return 0;

      // Validasi Tahun Rilis
      while (true) {
        cout << "Tahun Rilis         : ";
        if (cin >> tahun && tahun >= 1888) {
          cin.ignore(numeric_limits<streamsize>::max(), '\n');
          break;
        }
        cout << "Input tidak valid. Masukkan tahun rilis yang valid (>= "
                "1888).\n";
        cin.clear();
        cin.ignore(numeric_limits<streamsize>::max(), '\n');
      }

      cout << "Sutradara           : ";
      if (!getline(cin, sutradara))
        return 0;

      cout << "Genre               : ";
      if (!getline(cin, genre))
        return 0;

      // Validasi Durasi
      while (true) {
        cout << "Durasi (menit)      : ";
        if (cin >> durasi && durasi > 0) {
          cin.ignore(numeric_limits<streamsize>::max(), '\n');
          break;
        }
        cout << "Input tidak valid. Masukkan durasi dalam menit (> 0).\n";
        cin.clear();
        cin.ignore(numeric_limits<streamsize>::max(), '\n');
      }

      cout << "Studio Produksi     : ";
      if (!getline(cin, studio))
        return 0;

      cout << "Rating Usia         : ";
      if (!getline(cin, rating))
        return 0;

      // Validasi Harga Tiket
      while (true) {
        cout << "Harga Tiket (Rp)    : ";
        if (cin >> harga && harga > 0) {
          cin.ignore(numeric_limits<streamsize>::max(), '\n');
          break;
        }
        cout << "Input tidak valid. Masukkan harga tiket yang valid (> 0).\n";
        cin.clear();
        cin.ignore(numeric_limits<streamsize>::max(), '\n');
      }

      daftarFilm.push_back(FilmBioskop(id, judul, tahun, sutradara, genre,
                                       durasi, studio, rating, harga));
      cout << "\n✅ Film \"" << judul << "\" berhasil ditambahkan!\n";
    }
  } while (pilihan != 3);

  cout << "\nTerima kasih sudah menggunakan sistem bioskop!\n";
  return 0;
}
