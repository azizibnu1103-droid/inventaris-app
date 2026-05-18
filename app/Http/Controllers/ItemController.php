<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        // Tolak jika rolenya guru
        if (Auth::user()->role === 'guru') {
            return redirect()->route('items.index')->with('error', 'Akses Ditolak! Anda tidak memiliki izin menambah barang.');
        }
        return view('items.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'guru') return abort(403);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'stok_total'  => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('items', 'public') : null;

        Item::create([
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->kategori,
            'image'         => $imagePath,
            'stok_total'    => $request->stok_total,
            'stok_tersedia' => $request->stok_total,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (Auth::user()->role === 'guru') {
            return redirect()->route('items.index')->with('error', 'Akses Ditolak! Anda tidak memiliki izin mengedit barang.');
        }
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'guru') return abort(403);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'stok_total'  => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $item = Item::findOrFail($id);
        $selisih = $request->stok_total - $item->stok_total;
        
        $dataUpdate = [
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->kategori,
            'stok_total'    => $request->stok_total,
            'stok_tersedia' => $item->stok_tersedia + $selisih,
        ];

        if ($request->hasFile('image')) {
            if ($item->image) Storage::disk('public')->delete($item->image);
            $dataUpdate['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($dataUpdate);
        return redirect()->route('items.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // SATPAM: Tolak kalau BUKAN super_admin
        if (Auth::user()->role !== 'super_admin') {
            return redirect()->route('items.index')->with('error', 'Akses Ditolak! Hanya Super Admin yang bisa menghapus barang.');
        }

        $item = Item::findOrFail($id);
        if ($item->image) Storage::disk('public')->delete($item->image);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus secara permanen.');
    }
}