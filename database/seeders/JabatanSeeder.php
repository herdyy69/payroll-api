<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'jabatan_pegawai' => 'Manager',
            'gaji_pokok' => 10000000,
            'uang_makan' => 500000,
            'uang_transport' => 500000,
            'bonus' => 1000000
        ]);
        Jabatan::create([
            'jabatan_pegawai' => 'Supervisor',
            'gaji_pokok' => 5000000,
            'uang_makan' => 500000,
            'uang_transport' => 500000,
            'bonus' => 500000
        ]);
        Jabatan::create([
            'jabatan_pegawai' => 'Staff',
            'gaji_pokok' => 3000000,
            'uang_makan' => 500000,
            'uang_transport' => 500000,
            'bonus' => 0
        ]);
    }
}
