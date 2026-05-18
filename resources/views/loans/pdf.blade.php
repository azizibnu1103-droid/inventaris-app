<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Lab</title>
    <style>
        /* CSS Khusus PDF (DomPDF lebih suka CSS murni daripada Bootstrap) */
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #444; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        
        .footer { margin-top: 30px; text-align: right; font-style: italic; font-size: 10px; }
        .status-badge { font-weight: bold; padding: 2px 5px; border-radius: 3px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Peminjaman Barang Inventaris</h2>
        <p>Laboratorium Terpadu - Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Peminjam</th>
                <th width="25%">Nama Barang</th>
                <th width="10%">Jumlah</th>
                <th width="15%">Tgl Pinjam</th>
                <th width="15%">Tgl Kembali</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $index => $loan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $loan->nama_peminjam }}</td>
                <td>{{ $loan->item->nama_barang }}</td>
                <td style="text-align: center;">{{ $loan->jumlah }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->tgl_pinjam)->format('d/m/Y') }}</td>
                <td>{{ $loan->tgl_kembali ? \Carbon\Carbon::parse($loan->tgl_kembali)->format('d/m/Y') : '-' }}</td>
                <td>
                    <span class="status-badge">
                        {{ strtoupper($loan->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Laporan ini digenerate secara otomatis oleh Sistem Inventaris pada {{ date('d M Y, H:i') }}
    </div>

</body>
</html>