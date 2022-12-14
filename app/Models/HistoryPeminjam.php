<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPeminjam extends Model
{
    use HasFactory;

    protected $table = 'history_peminjam';

    protected $fillable = [
        'user_id',
        'alat_id',
        'bahan_id',
        'jumlah_alat',
        'jumlah_bahan',
        'tgl_kembali_alat',
        'tgl_kembali_bahan',
    ];

    public static function withUser() {
        return self::join('users', 'users.id', '=', 'history_peminjam.user_id')
        ->leftJoin('alat_lab', 'alat_lab.id', '=', 'history_peminjam.alat_id')
        ->leftJoin('bahan_lab', 'bahan_lab.id', '=', 'history_peminjam.bahan_id')
        ->select(
            'history_peminjam.id',
            'users.nama as nama_user',
            'users.nim',
            'users.telepon',
            'alat_lab.nama_alat',
            'alat_lab.merk as merk_alat',
            'alat_lab.jenis as jenis_alat',
            'bahan_lab.nama_bahan',
            'history_peminjam.jumlah_alat',
            'history_peminjam.jumlah_bahan',
            'history_peminjam.created_at as tanggal_pinjam'
        )
            ->selectRaw("concat(alat_lab.ukuran, ' ', alat_lab.satuan_ukuran) as ukuran_alat")
            ->orderBy('history_peminjam.created_at', 'desc')
            ->get();
    }
}
