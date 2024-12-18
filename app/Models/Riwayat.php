<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_riwayat',
        'id_reservasi',
        'id_dosen',
        'nama_riwayat',
        'tanggal',
        'pesan',
    ];
}
