import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    // Membuat garis horizontal batas tabel dinamis
    private static String buatGaris(int[] lebarKolom) {
        StringBuilder sb = new StringBuilder("+");
        for (int l : lebarKolom) {
            sb.append("-".repeat(l + 2)).append("+");
        }
        return sb.toString();
    }

    // Menampilkan seluruh data dalam satu tabel dinamis
    public static void tampilkanTabel(ArrayList<FilmBioskop> daftar, String judulTabel) {
        System.out.println("\n" + judulTabel);

        if (daftar.isEmpty()) {
            System.out.println("Tidak ada data untuk ditampilkan.");
            return;
        }

        String[] headers = {
            "ID", "Judul", "Tahun", "Sutradara", "Genre",
            "Durasi", "Studio Produksi", "Rating Usia", "Harga Tiket"
        };

        int nKolom = headers.length;
        int[] lebar = new int[nKolom];

        for (int i = 0; i < nKolom; i++) {
            lebar[i] = headers[i].length();
        }

        // Siapkan baris data teks
        ArrayList<String[]> barisData = new ArrayList<>();
        for (FilmBioskop f : daftar) {
            String[] baris = {
                f.getId(),
                f.getJudul(),
                String.valueOf(f.getTahunRilis()),
                f.getSutradara(),
                f.getGenre(),
                f.getDurasi() + " mnt",
                f.getStudioProduksi(),
                f.getRatingUsia(),
                "Rp " + f.getHargaTiket()
            };

            for (int i = 0; i < nKolom; i++) {
                if (baris[i].length() > lebar[i]) {
                    lebar[i] = baris[i].length();
                }
            }
            barisData.add(baris);
        }

        String garis = buatGaris(lebar);

        // Cetak batas atas
        System.out.println(garis);

        // Cetak header kolom
        System.out.print("|");
        for (int i = 0; i < nKolom; i++) {
            System.out.printf(" %-" + lebar[i] + "s |", headers[i]);
        }
        System.out.println();

        // Cetak pembatas header
        System.out.println(garis);

        // Cetak isi baris data
        for (String[] baris : barisData) {
            System.out.print("|");
            for (int i = 0; i < nKolom; i++) {
                System.out.printf(" %-" + lebar[i] + "s |", baris[i]);
            }
            System.out.println();
        }

        // Cetak batas bawah
        System.out.println(garis);
    }

    public static void main(String[] args) {
        ArrayList<FilmBioskop> daftarFilm = new ArrayList<>();

        // 5 Objek Awal (sebelum ada input user)
        daftarFilm.add(new FilmBioskop("FB01", "Avengers: Endgame", 2019, "Anthony Russo", "Action / Sci-Fi", 181, "Marvel Studios", "13+", 55000));
        daftarFilm.add(new FilmBioskop("FB02", "Interstellar", 2014, "Christopher Nolan", "Sci-Fi / Adventure", 169, "Paramount Pictures", "13+", 50000));
        daftarFilm.add(new FilmBioskop("FB03", "Spider-Man: No Way Home", 2021, "Jon Watts", "Action / Adventure", 148, "Columbia Pictures", "13+", 50000));
        daftarFilm.add(new FilmBioskop("FB04", "Thor: Ragnarok", 2017, "Taika Waititi", "Action / Comedy", 130, "Marvel Studios", "13+", 45000));
        daftarFilm.add(new FilmBioskop("FB05", "Oppenheimer", 2023, "Christopher Nolan", "Biography / Drama", 180, "Universal Pictures", "17+", 60000));

        // Tampilkan 5 objek awal
        tampilkanTabel(daftarFilm, "=== DATA AWAL FILM BIOSKOP (5 OBJEK) ===");

        Scanner scanner = new Scanner(System.in);
        System.out.print("\nMasukkan jumlah film yang ingin ditambahkan: ");

        if (scanner.hasNextInt()) {
            int n = scanner.nextInt();
            scanner.nextLine(); // membersihkan newline buffer

            for (int i = 1; i <= n; i++) {
                System.out.println("\n--- Input Data Film ke-" + i + " ---");

                System.out.print("ID Media            : ");
                String id = scanner.nextLine();

                System.out.print("Judul Film          : ");
                String judul = scanner.nextLine();

                System.out.print("Tahun Rilis         : ");
                int tahun = Integer.parseInt(scanner.nextLine());

                System.out.print("Sutradara           : ");
                String sutradara = scanner.nextLine();

                System.out.print("Genre               : ");
                String genre = scanner.nextLine();

                System.out.print("Durasi (menit)      : ");
                int durasi = Integer.parseInt(scanner.nextLine());

                System.out.print("Studio Produksi     : ");
                String studio = scanner.nextLine();

                System.out.print("Rating Usia         : ");
                String rating = scanner.nextLine();

                System.out.print("Harga Tiket (Rp)    : ");
                int harga = Integer.parseInt(scanner.nextLine());

                FilmBioskop filmBaru = new FilmBioskop(id, judul, tahun, sutradara, genre, durasi, studio, rating, harga);
                daftarFilm.add(filmBaru);
                System.out.println("Data film \"" + judul + "\" berhasil ditambahkan!");
            }
        }

        // Tampilkan data lengkap setelah penambahan
        tampilkanTabel(daftarFilm, "=== DATA SELURUH FILM BIOSKOP SETELAH PENAMBAHAN ===");
        scanner.close();
    }
}
