<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jadwal_dosen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_dosen', 'date', 'time'];

    // Define any necessary relationships, methods, etc.

    public function reservasi()
{
    return $this->hasMany(Reservasi::class, 'id_jadwal');
}

}
