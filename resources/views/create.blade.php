<h1>Tambah Barang</h1>

<form method="POST" action="/items">
@csrf

<input type="text" name="nama_barang" placeholder="Nama Barang"><br><br>
<input type="text" name="kategori" placeholder="Kategori"><br><br>
<input type="number" name="stok_total" placeholder="Stok"><br><br>

<button type="submit">Simpan</button>

</form>