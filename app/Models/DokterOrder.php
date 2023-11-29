<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_tindakan',
        'waktu_tindakan',
        'makanan',
        'minuman',
        'status',
        'belum_diproses',
        'sedang_diproses',
        'menunggu_pengantaran',
        'sedang_diantar',
        'selesai'
    ];
}
