<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal_praktik';

    protected $fillable = [
        'kelas',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];
}
