<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatLab extends Model
{
    use HasFactory;

    protected $table = 'alat_lab';

    protected $fillable = [
        'nama_alat',
        'ukuran',
        'satuan_ukuran',
        'jenis',
        'merk',
        'lokasi_penyimpanan',
        'jumlah_stock',
        'jumlah_dipinjam',
        'jumlah_pecah'
    ];
}
