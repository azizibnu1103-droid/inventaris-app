<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Barang
        $totalBarang = Item::sum('stok_total');
        $tersedia = Item::sum('stok_tersedia');
        $dipinjam = $totalBarang - $tersedia;

        // 2. Hitung Peminjaman yang belum dikembalikan (Status: dipinjam)
        $peminjamAktif = Loan::where('status', 'dipinjam')->count();

        // 3. Kirim data ke tampilan Dashboard
        return view('dashboard', compact('totalBarang', 'tersedia', 'dipinjam', 'peminjamAktif'));
    }
}