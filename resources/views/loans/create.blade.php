@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">FORM PEMINJAMAN BARANG</div>
                <div class="card-body p-4">
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        
                        {{-- Input Nama Peminjam Asli --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Peminjam (Siswa / Guru)</label>
                            <input type="text" name="nama_peminjam" class="form-control" placeholder="Contoh: Budi (Kelas 10) / Pak Joko" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Barang</label>
                            <select name="item_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Barang --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok: {{ $item->stok_tersedia }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Tenggat Kembali (Jatuh Tempo)</label>
                            <input type="date" name="tgl_kembali_seharusnya" class="form-control" required>
                            <div class="form-text text-muted">*Denda otomatis Rp 5.000/hari jika lewat tanggal ini.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold">PROSES PINJAM</button>
                            <a href="{{ route('loans.index') }}" class="btn btn-light border">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection