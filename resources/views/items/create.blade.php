@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    <i class="bi bi-box-seam me-2"></i> TAMBAH BARANG BARU
                </div>
                <div class="card-body p-4">

                    {{-- MENANGKAP PESAN ERROR DARI LARAVEL JIKA ADA YANG SALAH --}}
                    @if($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- WAJIB ADA enctype="multipart/form-data" AGAR BISA UPLOAD FOTO --}}
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="Contoh: Cat Tembok" required>
                        </div>

                        {{-- INI DIA INPUT KATEGORI YANG BIKIN ERROR TADI --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Barang</label>
                            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="Contoh: Bahan Bangunan, ATK, Elektronik" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok Total (Jumlah Barang)</label>
                            <input type="number" name="stok_total" class="form-control" value="{{ old('stok_total') }}" min="1" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Barang (Opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                            <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2 shadow-sm">SIMPAN BARANG</button>
                            <a href="{{ route('items.index') }}" class="btn btn-light border fw-bold">BATAL</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection