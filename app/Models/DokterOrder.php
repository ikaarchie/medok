<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_disajikan',
        'waktu_disajikan',
        'makanan',
        'ket_makanan',
        'ops_ket_makanan',
        'minuman',
        'ket_minuman',
        'ops_ket_minuman',
        'status',
        'belum_diproses',
        'sedang_diproses',
        'menunggu_pengantaran',
        'sedang_diantar',
        'selesai'
    ];
}
