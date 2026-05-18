<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // INI YANG PALING PENTING! Kalau kategori nggak ada di sini, data pasti ditolak.
    protected $fillable = [
        'nama_barang',
        'kategori',
        'image',
        'stok_total',
        'stok_tersedia',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}