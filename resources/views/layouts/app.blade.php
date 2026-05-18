<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Lab Modern</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* 1. GAYA UMUM & FONT */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9; /* Abu-abu sangat terang untuk background */
            color: #2e3a59; /* Biru tua untuk teks agar tidak kaku */
        }

        /* 2. NAVBAR MODERN */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05); /* Bayangan sangat halus */
            border-bottom: 1px solid #e1e8ed;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #4361ee !important; /* Warna biru utama */
        }
        
        .navbar-dark .navbar-nav .nav-link {
            color: #555 !important;
            font-weight: 400;
        }
        
        .navbar-dark .navbar-nav .nav-link:hover, 
        .navbar-dark .navbar-nav .nav-link.active {
            color: #4361ee !important;
            font-weight: 600;
        }

        /* 3. KARTU MODERN (Card) */
        .card {
            border: none;
            border-radius: 12px; /* Lebih melengkung */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.02); /* Bayangan estetik */
            transition: transform 0.2s, box-shadow 0.2s;
        }

        /* Efek hover untuk kartu statistik */
        .card-stats:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        /* Kotak statistik berwarna di kiri */
        .card-stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* 4. TOMBOL MODERN (Buttons) */
        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #3f37c9;
            border-color: #3f37c9;
            transform: translateY(-1px);
        }

        /* 5. TABEL MODERN */
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        }
        
        .table thead th {
            background-color: #fbfbfc;
            border-bottom: 2px solid #edf2f7;
            color: #8c98a4;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 15px;
        }
        
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            font-size: 13px;
        }

        /* 6. STATUS BADGE (Latar Transparan) */
        .badge-status {
            font-weight: 600;
            border-radius: 6px;
            font-size: 11px;
            padding: 4px 8px;
            letter-spacing: 0.3px;
        }
        
        .badge-available {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .badge-borrowed {
            background-color: rgba(244, 63, 94, 0.1);
            color: #f43f5e;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-box-seam me-2"></i> INVENTARIS<span class="fw-light text-muted">.LAB</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}" href="{{ route('items.index') }}">Data Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}" href="{{ route('loans.index') }}">Peminjaman</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle me-2 border" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                                <div class="rounded-circle me-2 bg-primary d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; font-weight: 700; font-size: 13px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="fw-semibold text-dark">{{ strtoupper(Auth::user()->name) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                    <i class="bi bi-person-lines-fill me-2"></i> Pengaturan Profil
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold py-2">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>