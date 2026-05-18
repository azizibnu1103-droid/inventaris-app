@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-uppercase border-bottom border-primary border-3 pb-2">
            🔄 Riwayat Peminjaman
        </h2>
        <a href="{{ route('loans.create') }}" class="btn btn-primary shadow-sm fw-bold">
            + PINJAM BARANG
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr class="small text-uppercase">
                        <th class="ps-4 py-3">Peminjam</th>
                        <th class="py-3">Barang</th>
                        <th class="py-3 text-center">Jumlah</th>
                        <th class="py-3">Tenggat</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Denda</th>
                        <th class="pe-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        {{-- Kolom Peminjam Diperbarui --}}
                        <td class="ps-4 py-3">
                            <div class="fw-bold text-primary fs-6">{{ $loan->nama_peminjam ?? 'Data Lama' }}</div>
                            <div class="small text-muted">Admin: {{ $loan->user->name ?? 'Unknown' }}</div>
                        </td>
                        
                        <td class="py-3 fw-semibold">
                            {{ $loan->item->nama_barang ?? 'Barang Terhapus' }}
                        </td>

                        <td class="py-3 text-center">
                            {{ $loan->jumlah }} unit
                        </td>

                        <td class="py-3">
                            @if($loan->tgl_kembali_seharusnya)
                                {{ $loan->tgl_kembali_seharusnya->format('d/m/Y') }}
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>

                        <td class="py-3">
                            @if($loan->status == 'dipinjam')
                                @if($loan->tgl_kembali_seharusnya && now()->startOfDay()->gt($loan->tgl_kembali_seharusnya))
                                    <span class="badge bg-danger p-2 text-uppercase">Terlambat</span>
                                @else
                                    <span class="badge bg-warning text-dark p-2 text-uppercase">Dipinjam</span>
                                @endif
                            @else
                                <span class="badge bg-success p-2 text-uppercase">Kembali</span>
                            @endif
                        </td>

                        <td class="py-3 fw-bold text-danger">
                            {{ $loan->denda > 0 ? 'Rp ' . number_format($loan->denda, 0, ',', '.') : '-' }}
                        </td>

                        <td class="pe-4 py-3 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                @if($loan->status == 'dipinjam')
                                    <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success fw-bold px-3">
                                            KEMBALIKAN
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-outline-dark px-3">
                                    EDIT
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <p class="mb-0">Belum ada riwayat peminjaman.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection