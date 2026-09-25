import sys
from FilmBioskop import FilmBioskop

# Daftar koleksi film
daftarFilm = []


def isIdExists(id_media: str) -> bool:
    return any(f.get_id_media().lower() == id_media.lower() for f in daftarFilm)


def maxLength(list_film, tipe: str) -> int:
    maks = len(tipe)
    for f in list_film:
        if tipe == "Harga":
            val = f"Rp{int(f.get_harga_tiket())}"
        elif tipe == "Durasi":
            val = f"{f.get_durasi()} menit"
        elif tipe == "Tahun":
            val = str(f.get_tahun_rilis())
        elif tipe == "ID":
            val = f.get_id_media()
        elif tipe == "Judul":
            val = f.get_judul()
        elif tipe == "Sutradara":
            val = f.get_sutradara()
        elif tipe == "Genre":
            val = f.get_genre()
        elif tipe == "Studio":
            val = f.get_studio_produksi()
        elif tipe == "Rating":
            val = f.get_rating_usia()
        else:
            val = ""
        maks = max(maks, len(val))
    return maks


def tampilkanTabel(list_film):
    if not list_film:
        print("\nBelum ada data film bioskop.\n")
        return

    wId = maxLength(list_film, "ID") + 2
    wJudul = maxLength(list_film, "Judul") + 2
    wTahun = maxLength(list_film, "Tahun") + 2
    wSutradara = maxLength(list_film, "Sutradara") + 2
    wGenre = maxLength(list_film, "Genre") + 2
    wDurasi = maxLength(list_film, "Durasi") + 2
    wStudio = maxLength(list_film, "Studio") + 2
    wRating = maxLength(list_film, "Rating") + 2
    wHarga = maxLength(list_film, "Harga") + 2

    line = "+" + "+".join([
        "-" * wId, "-" * wJudul, "-" * wTahun, "-" * wSutradara,
        "-" * wGenre, "-" * wDurasi, "-" * wStudio, "-" * wRating, "-" * wHarga
    ]) + "+"

    print("\n=== DAFTAR FILM BIOSKOP ===")
    print(line)

    header = "|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|".format(
        " ID", wId, " Judul", wJudul, " Tahun", wTahun, " Sutradara", wSutradara,
        " Genre", wGenre, " Durasi", wDurasi, " Studio", wStudio, " Rating", wRating, " Harga", wHarga
    )
    print(header)
    print(line)

    for f in list_film:
        row = "|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|{:<{}}|".format(
            " " + f.get_id_media() + " ", wId,
            " " + f.get_judul() + " ", wJudul,
            " " + str(f.get_tahun_rilis()) + " ", wTahun,
            " " + f.get_sutradara() + " ", wSutradara,
            " " + f.get_genre() + " ", wGenre,
            " " + str(f.get_durasi()) + " menit ", wDurasi,
            " " + f.get_studio_produksi() + " ", wStudio,
            " " + f.get_rating_usia() + " ", wRating,
            " Rp" + str(int(f.get_harga_tiket())) + " ", wHarga
        )
        print(row)

    print(line)


def main():
    # 5 Objek Awal (sebelum ada input user)
    daftarFilm.append(FilmBioskop("FB001", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000))
    daftarFilm.append(FilmBioskop("FB002", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000))
    daftarFilm.append(FilmBioskop("FB003", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000))
    daftarFilm.append(FilmBioskop("FB004", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000))
    daftarFilm.append(FilmBioskop("FB005", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000))

    while True:
        print("\n=== MENU BIOSKOP ===")
        print("1. Tampilkan Daftar Film")
        print("2. Tambah Film Bioskop Baru")
        print("3. Keluar")

        try:
            pilihan_str = input("Pilih menu: ").strip()
            if not pilihan_str:
                break
            pilihan = int(pilihan_str)
        except (ValueError, EOFError):
            break

        if pilihan == 1:
            tampilkanTabel(daftarFilm)
        elif pilihan == 2:
            print("\nMasukkan data film bioskop baru:")

            # Validasi ID unik
            while True:
                try:
                    id_media = input("ID Media            : ").strip()
                    if not id_media:
                        continue
                    if isIdExists(id_media):
                        print("ID ini sudah ada. Silakan masukkan ID lain.")
                        continue
                    break
                except EOFError:
                    return

            try:
                judul = input("Judul Film          : ").strip()
            except EOFError:
                return

            # Validasi Tahun Rilis
            while True:
                try:
                    tahun = int(input("Tahun Rilis         : ").strip())
                    if tahun >= 1888:
                        break
                    print("Input tidak valid. Masukkan tahun rilis yang valid (>= 1888).")
                except ValueError:
                    print("Input tidak valid. Masukkan angka tahun yang valid.")
                except EOFError:
                    return

            try:
                sutradara = input("Sutradara           : ").strip()
                genre = input("Genre               : ").strip()
            except EOFError:
                return

            # Validasi Durasi
            while True:
                try:
                    durasi = int(input("Durasi (menit)      : ").strip())
                    if durasi > 0:
                        break
                    print("Input tidak valid. Masukkan durasi dalam menit (> 0).")
                except ValueError:
                    print("Input tidak valid. Masukkan angka durasi yang valid.")
                except EOFError:
                    return

            try:
                studio = input("Studio Produksi     : ").strip()
                rating = input("Rating Usia         : ").strip()
            except EOFError:
                return

            # Validasi Harga Tiket
            while True:
                try:
                    harga = float(input("Harga Tiket (Rp)    : ").strip())
                    if harga > 0:
                        break
                    print("Input tidak valid. Masukkan harga tiket yang valid (> 0).")
                except ValueError:
                    print("Input tidak valid. Masukkan angka harga yang valid.")
                except EOFError:
                    return

            film_baru = FilmBioskop(id_media, judul, tahun, sutradara, genre, durasi, studio, rating, harga)
            daftarFilm.append(film_baru)
            print(f"\n✅ Film \"{judul}\" berhasil ditambahkan!")
        elif pilihan == 3:
            break

    print("\nTerima kasih sudah menggunakan sistem bioskop!")


if __name__ == "__main__":
    main()
