<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanLab extends Model
{
    use HasFactory;

    protected $table = 'bahan_lab';

    protected $fillable = [
        'nama_bahan',
        'rumus_kimia',
        'fasa',
        'golongan',
        'jumlah_stock',
        'jumlah_dipinjam',
    ];
}
