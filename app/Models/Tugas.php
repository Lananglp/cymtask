<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tugas',
        'penanggung_jawab',
        'deskripsi',
        'progress',
        'batas_waktu',
        'tenggat',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tugas_user');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    // protected $dates = ['created_at'];

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }
    
}
