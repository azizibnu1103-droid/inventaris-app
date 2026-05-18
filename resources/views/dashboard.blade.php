@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard Inventaris
        </h3>
    </div>

    {{-- KOTAK RINGKASAN DATA (KARTU STATISTIK) --}}
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="fw-bold opacity-75">Total Stok Barang</h6>
                    <h2 class="fw-bold mb-0">{{ $totalBarang }} <small class="fs-6 fw-normal">Unit</small></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="fw-bold opacity-75">Stok Tersedia</h6>
                    <h2 class="fw-bold mb-0">{{ $tersedia }} <small class="fs-6 fw-normal">Unit</small></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="fw-bold opacity-75">Barang Dipinjam</h6>
                    <h2 class="fw-bold mb-0">{{ $dipinjam }} <small class="fs-6 fw-normal">Unit</small></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow-sm border-0 h-100">
                <div class="card-body">
                    <h6 class="fw-bold opacity-75">Peminjam Aktif</h6>
                    <h2 class="fw-bold mb-0">{{ $peminjamAktif }} <small class="fs-6 fw-normal">Transaksi</small></h2>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN DIAGRAM BULAT (PIE CHART) & KARTU SELAMAT DATANG --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    <i class="bi bi-pie-chart-fill me-2"></i> Persentase Ketersediaan Barang
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 350px;">
                    {{-- Canvas ini akan digambar otomatis oleh Chart.js di bawah --}}
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 bg-light">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/3214/3214795.png" alt="Welcome" width="120" class="mb-4 opacity-75">
                    <h4 class="fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p class="text-muted mb-0">
                        Pantau terus pergerakan barang melalui dashboard ini. Pastikan semua peminjaman tercatat agar tidak ada aset yang hilang.
                    </p>
                    <div class="mt-4">
                        <span class="badge bg-secondary px-3 py-2 text-uppercase">{{ Auth::user()->role }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT UNTUK MENGAKTIFKAN CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('inventoryChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'doughnut', // Menggunakan model donat agar lebih modern
            data: {
                labels: ['Tersedia di Lab', 'Sedang Dipinjam'],
                datasets: [{
                    data: [{{ $tersedia }}, {{ $dipinjam }}],
                    backgroundColor: [
                        '#198754', // Hijau
                        '#ffc107'  // Kuning
                    ],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 14, weight: 'bold' } }
                    }
                },
                cutout: '60%' // Ukuran lubang di tengah donat
            }
        });
    });
</script>
@endsection