<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Petugas;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan petugas
        $petugas1 = Petugas::create([
            'nama_petugas' => 'Admin',
        ]);
        $petugas2 = Petugas::create([
            'nama_petugas' => 'Petugas',
        ]);

        // Menambahkan user dengan level admin
        User::create([
            'id_petugas' => $petugas1->id,
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'level' => 'admin',
        ]);

        // Menambahkan user dengan level petugas
        User::create([
            'id_petugas' => $petugas2->id,
            'username' => 'petugas',
            'password' => Hash::make('petugas'),
            'level' => 'petugas',
        ]);
    }
}