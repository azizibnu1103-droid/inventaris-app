<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Loan;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil data statistik dari database
        $totalBarang = Item::count();
        $barangDipinjam = Loan::where('status', 'dipinjam')->sum('jumlah');
        $stokMenipis = Item::where('stok_tersedia', '<', 5)->count();

        // Kirim data ke view dashboard
        return view('home', compact('totalBarang', 'barangDipinjam', 'stokMenipis'));
    }
}