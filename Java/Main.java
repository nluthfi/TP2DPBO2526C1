import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    private static ArrayList<FilmBioskop> daftarFilm = new ArrayList<>();

    // Fungsi untuk memeriksa apakah ID sudah ada
    private static boolean isIdExists(String id) {
        for (FilmBioskop f : daftarFilm) {
            if (f.getIdMedia().equalsIgnoreCase(id)) {
                return true;
            }
        }
        return false;
    }

    // Fungsi cari panjang string maksimal di kolom tertentu
    private static int maxLength(ArrayList<FilmBioskop> list, String tipe) {
        int maks = tipe.length();

        if (tipe.equals("Harga")) {
            for (FilmBioskop f : list) {
                String val = "Rp" + (long) f.getHargaTiket();
                if (val.length() > maks) maks = val.length();
            }
        } else if (tipe.equals("Durasi")) {
            for (FilmBioskop f : list) {
                String val = f.getDurasi() + " menit";
                if (val.length() > maks) maks = val.length();
            }
        } else if (tipe.equals("Tahun")) {
            for (FilmBioskop f : list) {
                String val = String.valueOf(f.getTahunRilis());
                if (val.length() > maks) maks = val.length();
            }
        } else {
            for (FilmBioskop f : list) {
                String val = "";
                if (tipe.equals("ID")) val = f.getIdMedia();
                else if (tipe.equals("Judul")) val = f.getJudul();
                else if (tipe.equals("Sutradara")) val = f.getSutradara();
                else if (tipe.equals("Genre")) val = f.getGenre();
                else if (tipe.equals("Studio")) val = f.getStudioProduksi();
                else if (tipe.equals("Rating")) val = f.getRatingUsia();

                if (val.length() > maks) maks = val.length();
            }
        }
        return maks;
    }

    // Menampilkan seluruh data dalam format tabel dinamis
    public static void tampilkanTabel(ArrayList<FilmBioskop> list) {
        if (list.isEmpty()) {
            System.out.println("\nBelum ada data film bioskop.");
            return;
        }

        int wId        = maxLength(list, "ID") + 2;
        int wJudul     = maxLength(list, "Judul") + 2;
        int wTahun     = maxLength(list, "Tahun") + 2;
        int wSutradara = maxLength(list, "Sutradara") + 2;
        int wGenre     = maxLength(list, "Genre") + 2;
        int wDurasi    = maxLength(list, "Durasi") + 2;
        int wStudio    = maxLength(list, "Studio") + 2;
        int wRating    = maxLength(list, "Rating") + 2;
        int wHarga     = maxLength(list, "Harga") + 2;

        String line = "+" + "-".repeat(wId)
                    + "+" + "-".repeat(wJudul)
                    + "+" + "-".repeat(wTahun)
                    + "+" + "-".repeat(wSutradara)
                    + "+" + "-".repeat(wGenre)
                    + "+" + "-".repeat(wDurasi)
                    + "+" + "-".repeat(wStudio)
                    + "+" + "-".repeat(wRating)
                    + "+" + "-".repeat(wHarga) + "+";

        System.out.println("\n=== DAFTAR FILM BIOSKOP ===");
        System.out.println(line);

        System.out.printf("|%-" + wId + "s|%-" + wJudul + "s|%-" + wTahun + "s|%-" + wSutradara + "s|%-" + wGenre + "s|%-" + wDurasi + "s|%-" + wStudio + "s|%-" + wRating + "s|%-" + wHarga + "s|\n",
                " ID", " Judul", " Tahun", " Sutradara", " Genre", " Durasi", " Studio", " Rating", " Harga");

        System.out.println(line);

        for (FilmBioskop f : list) {
            System.out.printf("|%-" + wId + "s|%-" + wJudul + "s|%-" + wTahun + "s|%-" + wSutradara + "s|%-" + wGenre + "s|%-" + wDurasi + "s|%-" + wStudio + "s|%-" + wRating + "s|%-" + wHarga + "s|\n",
                    " " + f.getIdMedia() + " ",
                    " " + f.getJudul() + " ",
                    " " + f.getTahunRilis() + " ",
                    " " + f.getSutradara() + " ",
                    " " + f.getGenre() + " ",
                    " " + f.getDurasi() + " menit ",
                    " " + f.getStudioProduksi() + " ",
                    " " + f.getRatingUsia() + " ",
                    " Rp" + (long) f.getHargaTiket() + " ");
        }

        System.out.println(line);
    }

    public static void main(String[] args) {
        // 5 Objek Awal (sebelum ada input user)
        daftarFilm.add(new FilmBioskop("FB001", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000));
        daftarFilm.add(new FilmBioskop("FB002", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000));
        daftarFilm.add(new FilmBioskop("FB003", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000));
        daftarFilm.add(new FilmBioskop("FB004", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000));
        daftarFilm.add(new FilmBioskop("FB005", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000));

        Scanner scanner = new Scanner(System.in);
        int pilihan = 0;

        do {
            System.out.println("\n=== MENU BIOSKOP ===");
            System.out.println("1. Tampilkan Daftar Film");
            System.out.println("2. Tambah Film Bioskop Baru");
            System.out.println("3. Keluar");
            System.out.print("Pilih menu: ");

            if (!scanner.hasNextInt()) {
                break;
            }

            pilihan = scanner.nextInt();
            scanner.nextLine(); // membersihkan buffer

            if (pilihan == 1) {
                tampilkanTabel(daftarFilm);
            } else if (pilihan == 2) {
                System.out.println("\nMasukkan data film bioskop baru:");

                // Validasi ID unik
                String id = "";
                do {
                    System.out.print("ID Media            : ");
                    if (!scanner.hasNextLine()) return;
                    id = scanner.nextLine().trim();
                    if (isIdExists(id)) {
                        System.out.println("ID ini sudah ada. Silakan masukkan ID lain.");
                    }
                } while (isIdExists(id));

                System.out.print("Judul Film          : ");
                if (!scanner.hasNextLine()) return;
                String judul = scanner.nextLine().trim();

                // Validasi Tahun Rilis
                int tahun = 0;
                while (true) {
                    System.out.print("Tahun Rilis         : ");
                    if (scanner.hasNextInt()) {
                        tahun = scanner.nextInt();
                        scanner.nextLine();
                        if (tahun >= 1888) break;
                    } else {
                        scanner.nextLine();
                    }
                    System.out.println("Input tidak valid. Masukkan tahun rilis yang valid (>= 1888).");
                }

                System.out.print("Sutradara           : ");
                if (!scanner.hasNextLine()) return;
                String sutradara = scanner.nextLine().trim();

                System.out.print("Genre               : ");
                if (!scanner.hasNextLine()) return;
                String genre = scanner.nextLine().trim();

                // Validasi Durasi
                int durasi = 0;
                while (true) {
                    System.out.print("Durasi (menit)      : ");
                    if (scanner.hasNextInt()) {
                        durasi = scanner.nextInt();
                        scanner.nextLine();
                        if (durasi > 0) break;
                    } else {
                        scanner.nextLine();
                    }
                    System.out.println("Input tidak valid. Masukkan durasi dalam menit (> 0).");
                }

                System.out.print("Studio Produksi     : ");
                if (!scanner.hasNextLine()) return;
                String studio = scanner.nextLine().trim();

                System.out.print("Rating Usia         : ");
                if (!scanner.hasNextLine()) return;
                String rating = scanner.nextLine().trim();

                // Validasi Harga Tiket
                double harga = 0;
                while (true) {
                    System.out.print("Harga Tiket (Rp)    : ");
                    if (scanner.hasNextDouble()) {
                        harga = scanner.nextDouble();
                        scanner.nextLine();
                        if (harga > 0) break;
                    } else {
                        scanner.nextLine();
                    }
                    System.out.println("Input tidak valid. Masukkan harga tiket yang valid (> 0).");
                }

                daftarFilm.add(new FilmBioskop(id, judul, tahun, sutradara, genre, durasi, studio, rating, harga));
                System.out.println("\n✅ Film \"" + judul + "\" berhasil ditambahkan!");
            }
        } while (pilihan != 3);

        System.out.println("\nTerima kasih sudah menggunakan sistem bioskop!");
        scanner.close();
    }
}
