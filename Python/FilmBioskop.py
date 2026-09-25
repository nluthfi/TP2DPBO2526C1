from Film import Film

# Subclass Level 2 (Multilevel Inheritance): FilmBioskop (mewarisi Film)
# Menambahkan atribut spesifik penayangan film di bioskop
class FilmBioskop(Film):
    def __init__(self, id_media: str = "", judul: str = "", tahun_rilis: int = 0,
                 sutradara: str = "", genre: str = "", durasi: int = 0,
                 studio_produksi: str = "", rating_usia: str = "", harga_tiket: float = 0.0):
        super().__init__(id_media, judul, tahun_rilis, sutradara, genre, durasi)
        self._studio_produksi = studio_produksi
        self._rating_usia = rating_usia
        self._harga_tiket = harga_tiket

    # Setter
    def set_studio_produksi(self, studio_produksi: str):
        self._studio_produksi = studio_produksi

    def set_rating_usia(self, rating_usia: str):
        self._rating_usia = rating_usia

    def set_harga_tiket(self, harga_tiket: float):
        self._harga_tiket = harga_tiket

    # Getter
    def get_studio_produksi(self) -> str:
        return self._studio_produksi

    def get_rating_usia(self) -> str:
        return self._rating_usia

    def get_harga_tiket(self) -> float:
        return self._harga_tiket

    # Prosedur menampilkan data
    def tampilkan_data(self):
        super().tampilkan_data()
        print(f"Studio      : {self.get_studio_produksi()}")
        print(f"Rating Usia : {self.get_rating_usia()}")
        print(f"Harga Tiket : Rp{int(self.get_harga_tiket())}")
