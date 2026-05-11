<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
   public function run(): void
    {

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
