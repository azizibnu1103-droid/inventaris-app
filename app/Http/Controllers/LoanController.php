<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan di bagian paling atas (bawah namespace)
use App\Models\Loan;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Menampilkan semua riwayat peminjaman.
     */
    public function index()
    {
        $loans = Loan::with(['item', 'user'])->latest()->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Menampilkan form untuk meminjam barang.
     */
    public function create()
    {
        $items = Item::where('stok_tersedia', '>', 0)->get();
        return view('loans.create', compact('items'));
    }

    /**
     * Menyimpan data peminjaman baru ke database.
     */
    public function store(Request $request)
    {
        // 1. TAMBAH VALIDASI NAMA PEMINJAM DI SINI
        $request->validate([
            'nama_peminjam' => 'required|string|max:255', 
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer|min:1',
            'tgl_kembali_seharusnya' => 'required|date',
        ]);

        $item = Item::findOrFail($request->item_id);
        
        if ($item->stok_tersedia < $request->jumlah) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }

        // 2. SIMPAN NAMA PEMINJAM KE DATABASE
        Loan::create([
            'user_id' => Auth::id(), // Ini ID Admin yang lagi login (sebagai pencatat)
            'nama_peminjam' => $request->nama_peminjam, // Ini nama asli siswa/guru
            'item_id' => $request->item_id,
            'jumlah' => $request->jumlah,
            'tgl_pinjam' => now(),
            'tgl_kembali_seharusnya' => $request->tgl_kembali_seharusnya,
            'status' => 'dipinjam',
        ]);

        $item->decrement('stok_tersedia', $request->jumlah);

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Menampilkan halaman edit denda manual.
     */
    public function edit($id)
    {
        $loan = Loan::with('item')->findOrFail($id);
        return view('loans.edit', compact('loan'));
    }

    /**
     * Update denda atau status secara manual (Fitur Admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'denda' => 'required|integer|min:0',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $loan = Loan::findOrFail($id);
        $loan->update([
            'denda' => $request->denda,
            'status' => $request->status,
        ]);

        return redirect()->route('loans.index')->with('success', 'Data peminjaman diperbarui secara manual!');
    }

    /**
     * Menangani pengembalian barang dan hitung denda otomatis.
     */
    public function return($id)
    {
        $loan = Loan::findOrFail($id);
        
        if ($loan->status === 'dikembalikan') return back();

        $totalDenda = 0;
        $hariIni = now()->startOfDay();

        if ($loan->tgl_kembali_seharusnya) {
            $tenggat = \Carbon\Carbon::parse($loan->tgl_kembali_seharusnya)->startOfDay();
            if ($hariIni->gt($tenggat)) {
                $selisihHari = $hariIni->diffInDays($tenggat);
                $totalDenda = $selisihHari * 5000; // Denda Rp 5.000 per hari
            }
        }

        $loan->update([
            'status' => 'dikembalikan',
            'tgl_kembali' => now(),
            'denda' => $totalDenda,
        ]);

        $loan->item->increment('stok_tersedia', $loan->jumlah);

        return redirect()->route('loans.index')->with('success', 'Barang kembali! Denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
    }

    /**
     * Ekspor data peminjaman ke format PDF.
     */
    public function exportPDF()
    {
        $loans = Loan::with(['item', 'user'])->get();
        
        $pdf = Pdf::loadView('loans.pdf', compact('loans'));
        return $pdf->download('Laporan_Peminjaman_Lab.pdf');
    }
}