<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kepuasan_1',
        'kepuasan_2',
        'kepuasan_3',
        'kepuasan_4',
        'kepuasan_5',
        'kepuasan_6',
        'kepentingan_1',
        'kepentingan_2',
        'kepentingan_3',
        'kepentingan_4',
        'kepentingan_5',
        'kepentingan_6'
    ];
}
