<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'id_jadwal', // Pastikan field ini sesuai dengan migrasi
        'nama_awal',
        'nama_tengah',
        'nama_akhir',
        'keperluan',
        'selesai',
    ];

    /**
     * Relasi ke model Jadwal (jadwal_dosen)
     */
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function mahasiswa()
{
    return $this->belongsTo(User::class, 'id_mahasiswa');
}

}
