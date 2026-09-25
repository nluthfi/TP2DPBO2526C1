from film import Film

# Subclass Level 2 (Multilevel Inheritance): FilmBioskop
# Mewarisi Film (yang mewarisi Media)
# Menambahkan atribut spesifik penayangan di bioskop
class FilmBioskop(Film):
    def __init__(self, id: str = "", judul: str = "", tahun_rilis: int = 0,
                 sutradara: str = "", genre: str = "", durasi: int = 0,
                 studio_produksi: str = "", rating_usia: str = "", harga_tiket: int = 0):
        super().__init__(id, judul, tahun_rilis, sutradara, genre, durasi)
        self._studio_produksi = studio_produksi
        self._rating_usia = rating_usia  # contoh: SU, 13+, 17+, 21+
        self._harga_tiket = harga_tiket  # dalam Rupiah

    # Getter & Setter untuk Studio Produksi
    def get_studio_produksi(self) -> str:
        return self._studio_produksi

    def set_studio_produksi(self, studio_produksi: str):
        self._studio_produksi = studio_produksi

    # Getter & Setter untuk Rating Usia
    def get_rating_usia(self) -> str:
        return self._rating_usia

    def set_rating_usia(self, rating_usia: str):
        self._rating_usia = rating_usia

    # Getter & Setter untuk Harga Tiket
    def get_harga_tiket(self) -> int:
        return self._harga_tiket

    def set_harga_tiket(self, harga_tiket: int):
        self._harga_tiket = harga_tiket
