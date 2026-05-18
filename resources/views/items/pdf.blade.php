<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; font-weight: bold; }
        h2 { text-align: center; color: #1e3a8a; }
    </style>
</head>
<body>
    <h2>LAPORAN INVENTARIS ASSET</h2>
    <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok Total</th>
                <th>Tersedia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->stok_total }}</td>
                <td>{{ $item->stok_tersedia }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>