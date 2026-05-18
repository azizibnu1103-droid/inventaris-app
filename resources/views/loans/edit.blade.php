@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold text-uppercase">Edit Data Peminjaman</div>
                <div class="card-body p-4">
                    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <input type="text" class="form-control bg-light" value="{{ $loan->item->nama_barang }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Peminjaman</label>
                            <select name="status" class="form-select">
                                <option value="dipinjam" {{ $loan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="dikembalikan" {{ $loan->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Total Denda (Manual)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="denda" class="form-control" value="{{ $loan->denda }}" required>
                            </div>
                            <small class="text-muted">*Ubah angka ini jika ingin memberikan diskon atau denda manual.</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary fw-bold">UPDATE DATA</button>
                            <a href="{{ route('loans.index') }}" class="btn btn-light border">KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection