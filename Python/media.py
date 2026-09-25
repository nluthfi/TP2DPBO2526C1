# Base Class: Media
# Merepresentasikan data umum karya media digital
class Media:
    def __init__(self, id: str = "", judul: str = "", tahun_rilis: int = 0):
        self._id = id
        self._judul = judul
        self._tahun_rilis = tahun_rilis

    # Getter & Setter untuk ID
    def get_id(self) -> str:
        return self._id

    def set_id(self, id: str):
        self._id = id

    # Getter & Setter untuk Judul
    def get_judul(self) -> str:
        return self._judul

    def set_judul(self, judul: str):
        self._judul = judul

    # Getter & Setter untuk Tahun Rilis
    def get_tahun_rilis(self) -> int:
        return self._tahun_rilis

    def set_tahun_rilis(self, tahun_rilis: int):
        self._tahun_rilis = tahun_rilis
