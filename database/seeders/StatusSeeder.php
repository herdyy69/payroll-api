<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'status_pegawai' => 'Tetap',
            'bonus' => 1000000
        ]);
        Status::create([
            'status_pegawai' => 'Kontrak',
            'bonus' => 500000
        ]);
        Status::create([
            'status_pegawai' => 'Magang',
            'bonus' => 0
        ]);
    }
}
