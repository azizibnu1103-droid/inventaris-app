<h1>Data Barang</h1>

<a href="/items/create">Tambah Barang</a>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Stok</th>
</tr>

@foreach($items as $item)
<tr>
    <td>{{ $item->nama_barang }}</td>
    <td>{{ $item->kategori }}</td>
    <td>{{ $item->stok_tersedia }}</td>
</tr>
@endforeach
</table>