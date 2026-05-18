@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Card Utama untuk Edit --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="card-title mb-0 fw-bold text-uppercase">Edit Barang</h5>
                </div>
                <div class="card-body p-4">
                    {{-- FORM UNTUK UPDATE --}}
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $item->nama_barang }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Stok Total di Gudang</label>
                            <input type="number" name="stok_total" class="form-control" value="{{ $item->stok_total }}" min="0" required>
                            <div class="form-text mt-2 text-muted">
                                Stok tersedia saat ini: <strong>{{ $item->stok_tersedia }}</strong> unit.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm">SIMPAN PERUBAHAN</button>
                        </div>
                    </form>

                    <hr class="my-4">

                    {{-- FORM UNTUK HAPUS (Zona Bahaya) --}}
                    <div class="text-center mb-2">
                        <small class="text-danger fw-bold text-uppercase">Hapus Data</small>
                    </div>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" 
                          onsubmit="return confirm('PENTING: Menghapus barang ini akan menghapus semua riwayat transaksi terkait. Lanjutkan?')">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus Barang Secara Permanen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('items.index') }}" class="text-decoration-none text-secondary small">
                    &larr; Kembali ke Daftar Inventaris
                </a>
            </div>
        </div>
    </div>
</div>
@endsection