import sys
from film_bioskop import FilmBioskop


def buat_garis(lebar_kolom):
    return "+" + "+".join("-" * (w + 2) for w in lebar_kolom) + "+"


def tampilkan_tabel(daftar, judul_tabel):
    print(f"\n{judul_tabel}")

    if not daftar:
        print("Tidak ada data untuk ditampilkan.")
        return

    headers = [
        "ID", "Judul", "Tahun", "Sutradara", "Genre",
        "Durasi", "Studio Produksi", "Rating Usia", "Harga Tiket"
    ]

    lebar = [len(h) for h in headers]

    baris_data = []
    for f in daftar:
        baris = [
            f.get_id(),
            f.get_judul(),
            str(f.get_tahun_rilis()),
            f.get_sutradara(),
            f.get_genre(),
            f"{f.get_durasi()} mnt",
            f.get_studio_produksi(),
            f.get_rating_usia(),
            f"Rp {f.get_harga_tiket()}"
        ]
        for i in range(len(headers)):
            if len(baris[i]) > lebar[i]:
                lebar[i] = len(baris[i])
        baris_data.append(baris)

    garis = buat_garis(lebar)

    # Cetak garis atas
    print(garis)

    # Cetak header
    header_str = "|" + "|".join(f" {headers[i]:<{lebar[i]}} " for i in range(len(headers))) + "|"
    print(header_str)

    # Cetak pembatas
    print(garis)

    # Cetak baris data
    for baris in baris_data:
        row_str = "|" + "|".join(f" {baris[i]:<{lebar[i]}} " for i in range(len(headers))) + "|"
        print(row_str)

    # Cetak garis penutup
    print(garis)


def main():
    # 5 Objek Awal (sebelum ada input user)
    daftar_film = [
        FilmBioskop("FB01", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000),
        FilmBioskop("FB02", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000),
        FilmBioskop("FB03", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000),
        FilmBioskop("FB04", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000),
        FilmBioskop("FB05", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000),
    ]

    # Tampilkan 5 objek awal
    tampilkan_tabel(daftar_film, "=== DATA AWAL FILM BIOSKOP (5 OBJEK) ===")

    try:
        n_input = input("\nMasukkan jumlah film yang ingin ditambahkan: ").strip()
        if not n_input:
            return
        n = int(n_input)
    except (ValueError, EOFError):
        return

    for i in range(1, n + 1):
        print(f"\n--- Input Data Film ke-{i} ---")
        try:
            id_film = input("ID Media            : ").strip()
            judul = input("Judul Film          : ").strip()
            tahun = int(input("Tahun Rilis         : ").strip())
            sutradara = input("Sutradara           : ").strip()
            genre = input("Genre               : ").strip()
            durasi = int(input("Durasi (menit)      : ").strip())
            studio = input("Studio Produksi     : ").strip()
            rating = input("Rating Usia         : ").strip()
            harga = int(input("Harga Tiket (Rp)    : ").strip())

            film_baru = FilmBioskop(id_film, judul, tahun, sutradara, genre, durasi, studio, rating, harga)
            daftar_film.append(film_baru)
            print(f"Data film \"{judul}\" berhasil ditambahkan!")
        except (ValueError, EOFError) as e:
            print("Format input tidak valid:", e)
            break

    # Tampilkan tabel akhir setelah penambahan
    tampilkan_tabel(daftar_film, "=== DATA SELURUH FILM BIOSKOP SETELAH PENAMBAHAN ===")


if __name__ == "__main__":
    main()
