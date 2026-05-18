@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i> Daftar Inventaris Barang</h3>
        
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
            <a href="{{ route('items.create') }}" class="btn btn-primary fw-bold shadow-sm">
                <i class="bi bi-plus-lg"></i> Tambah Barang
            </a>
        @endif
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" style="width: 80px;">Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok (Tersedia/Total)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td class="ps-4">
                            {{-- LOGIKA MENAMPILKAN GAMBAR BARANG --}}
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="Foto {{ $item->nama_barang }}" 
                                     class="rounded shadow-sm" 
                                     style="width: 60px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                            @else
                                {{-- Jika barang tidak ada foto, tampilkan ikon box --}}
                                <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded" 
                                     style="width: 60px; height: 60px; border: 1px solid #ddd;">
                                    <i class="bi bi-image" style="font-size: 24px;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                            <small class="text-muted">ID: #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark px-2 py-1">{{ $item->kategori }}</span>
                        </td>
                        <td>
                            @php
                                $persenStok = ($item->stok_tersedia / $item->stok_total) * 100;
                                $warnaSinyal = $persenStok <= 20 ? 'text-danger' : ($persenStok <= 50 ? 'text-warning' : 'text-success');
                            @endphp
                            <span class="fw-bold {{ $warnaSinyal }}">{{ $item->stok_tersedia }}</span> 
                            <span class="text-muted">/ {{ $item->stok_total }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endif

                                @if(Auth::user()->role === 'super_admin')
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" 
                                          onsubmit="return confirm('Hapus barang {{ $item->nama_barang }}?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada barang di inventaris.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection