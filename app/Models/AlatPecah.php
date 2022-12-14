<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatPecah extends Model {
    use HasFactory;

    protected $table = 'alat_pecah';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
    ];

    public static function withUser() {
        return self::join('users', 'users.id', '=', 'alat_pecah.user_id')
            ->join('alat_lab', 'alat_lab.id', '=', 'alat_pecah.alat_id')
            ->select(
                'alat_pecah.id',
                'users.nama as nama_user',
                'users.nim',
                'alat_lab.nama_alat',
                'alat_pecah.jumlah',
                'users.telepon',
                'alat_pecah.created_at as tanggal'
            )
            ->orderBy('alat_pecah.created_at', 'desc')
            ->get();
    }
}
