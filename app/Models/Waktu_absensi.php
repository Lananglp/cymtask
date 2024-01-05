<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu_absensi extends Model
{
    protected $table = 'waktu_absensi';

    protected $fillable = [
        'awalMasuk',
        'akhirMasuk',
        'awalKeluar',
        'akhirKeluar',
        // 'batasAbsensi',
    ];

    use HasFactory;
}
