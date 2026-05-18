<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'loan_id',
        'jumlah_denda',
        'status_bayar'
    ];
}
