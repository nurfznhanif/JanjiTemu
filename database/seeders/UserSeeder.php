<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class  UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Hahaha',
            'email' => 'hahaha@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'gender' => 'L',
            'jurusan' => 'Teknik Informatika',
            'no_hp' => '0000000',
        ]);
    }
}
