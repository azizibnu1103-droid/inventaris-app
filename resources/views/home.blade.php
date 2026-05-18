@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h2 class="fw-bold text-dark">DASHBOARD SISTEM INVENTARIS</h2>
                <p class="text-muted small uppercase fw-bold">Ringkasan Data Aset Sekolah</p>
            </div>

            <div class="row">
                <!-- Card Total Barang -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-primary text-white h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-4">
                            <h6 class="text-uppercase fw-black opacity-75 small">Total Jenis Barang</h6>
                            <h1 class="display-4 fw-bold mb-0">{{ $totalBarang }}</h1>
                        </div>
                    </div>
                </div>

                <!-- Card Barang Sedang Dipinjam -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-dark text-white h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-4">
                            <h6 class="text-uppercase fw-black opacity-75 small">Unit Sedang Dipinjam</h6>
                            <h1 class="display-4 fw-bold mb-0">{{ $barangDipinjam }}</h1>
                        </div>
                    </div>
                </div>

                <!-- Card Peringatan Stok -->
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-danger text-white h-100">
                        <div class="card-body d-flex flex-column justify-content-center p-4">
                            <h6 class="text-uppercase fw-black opacity-75 small">Barang Hampir Habis</h6>
                            <h1 class="display-4 fw-bold mb-0">{{ $stokMenipis }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesan Sambutan -->
            <div class="card border-0 shadow-sm mt-2">
                <div class="card-body p-4 text-center">
                    <h5 class="mb-1">Selamat Datang, <strong>{{ Auth::user()->name }}</strong>!</h5>
                    <p class="text-muted mb-0">Gunakan menu navigasi di atas untuk mengelola aset atau melakukan transaksi peminjaman.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection