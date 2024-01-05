<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';

    protected $fillable = [
        'komentar',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function tugas()
    // {
    //     return $this->hasMany(Tugas::class, 'tugas_id');
    // }
}
