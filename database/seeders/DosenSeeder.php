<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run()
    {
        Dosen::create([
            'name' => 'Nurfauzan Hanif, PhD',
            'email' => 'nrfznhnf@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'gender' => 'L',
            'jurusan' => 'Teknik Informatika',
            'no_hp' => '0000000',
        ]);
    }
}
