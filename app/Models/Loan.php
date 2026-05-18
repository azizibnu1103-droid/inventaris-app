<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'item_id', 
        'nama_peminjam', // Kolom baru untuk Siswa/Guru
        'jumlah', 
        'tgl_pinjam', 
        'tgl_kembali_seharusnya', 
        'tgl_kembali', 
        'status', 
        'denda'
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali_seharusnya' => 'date',
        'tgl_kembali' => 'date',
    ];

    public function item() { return $this->belongsTo(Item::class); }
    public function user() { return $this->belongsTo(User::class); }
}