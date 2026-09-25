from Media import Media

# Subclass Level 1: Film (mewarisi Media)
# Menambahkan atribut spesifik karya perfilman
class Film(Media):
    def __init__(self, id_media: str = "", judul: str = "", tahun_rilis: int = 0,
                 sutradara: str = "", genre: str = "", durasi: int = 0):
        super().__init__(id_media, judul, tahun_rilis)
        self._sutradara = sutradara
        self._genre = genre
        self._durasi = durasi  # dalam menit

    # Setter
    def set_sutradara(self, sutradara: str):
        self._sutradara = sutradara

    def set_genre(self, genre: str):
        self._genre = genre

    def set_durasi(self, durasi: int):
        self._durasi = durasi

    # Getter
    def get_sutradara(self) -> str:
        return self._sutradara

    def get_genre(self) -> str:
        return self._genre

    def get_durasi(self) -> int:
        return self._durasi

    # Prosedur menampilkan data
    def tampilkan_data(self):
        super().tampilkan_data()
        print(f"Sutradara   : {self.get_sutradara()}")
        print(f"Genre       : {self.get_genre()}")
        print(f"Durasi      : {self.get_durasi()} menit")
