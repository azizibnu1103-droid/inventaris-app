<h2>Laporan Barang</h2>

<table border="1" width="100%">
<tr><th>Nama</th><th>Kategori</th><th>Stok</th></tr>

@foreach($items as $item)
<tr>
<td>{{ $item->nama_barang }}</td>
<td>{{ $item->kategori }}</td>
<td>{{ $item->stok_tersedia }}</td>
</tr>
@endforeach

</table>