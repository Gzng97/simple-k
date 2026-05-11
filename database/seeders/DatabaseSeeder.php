<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Penduduk::create([
            'nik' => '350375863976534',
            'nama' => 'King Rusdi',
            'jk' => 'L',
            'alamat' => 'Ngawi Selatan, RT02, RW04, Jl Rodok',
        ]);

        Penduduk::create([
            'nik' => '350375863976497',
            'nama' => 'Edo Golose',
            'jk' => 'L',
            'alamat' => 'Malang Selatan, RT22, RW24, Jl Surya',
        ]);
    }
}
