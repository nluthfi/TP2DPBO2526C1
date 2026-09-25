from media import Media

# Subclass Level 1: Film
# Mewarisi Media, menambahkan atribut spesifik karya film
class Film(Media):
    def __init__(self, id: str = "", judul: str = "", tahun_rilis: int = 0,
                 sutradara: str = "", genre: str = "", durasi: int = 0):
        super().__init__(id, judul, tahun_rilis)
        self._sutradara = sutradara
        self._genre = genre
        self._durasi = durasi  # dalam menit

    # Getter & Setter untuk Sutradara
    def get_sutradara(self) -> str:
        return self._sutradara

    def set_sutradara(self, sutradara: str):
        self._sutradara = sutradara

    # Getter & Setter untuk Genre
    def get_genre(self) -> str:
        return self._genre

    def set_genre(self, genre: str):
        self._genre = genre

    # Getter & Setter untuk Durasi
    def get_durasi(self) -> int:
        return self._durasi

    def set_durasi(self, durasi: int):
        self._durasi = durasi
