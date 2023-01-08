<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            $karyawan = \App\Models\Karyawan::create([
                'pegawai' => $faker->randomElement(['Aktif', 'Tidak Aktif']),
                'nama_pegawai' => $faker->name,
                'nik' => $faker->nik,
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'email' => $faker->email,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date,
                'status_hubungan' => $faker->randomElement(['Menikah', 'Belum Menikah']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
                'foto' => $faker->image('public/images/foto_karyawan', 640, 480, null, false),
                'tanggal_masuk' => $faker->date,
                'tanggal_keluar' => $faker->date,
                'lama_kerja' => $faker->numberBetween(1, 10),
                'keterangan' => $faker->text,
                'nama_bank' => $faker->randomElement([
                    'CIMB NIAGA',
                    'CASH',
                ]),
                'no_rekening' => $faker->bankAccountNumber,
                'atas_nama' => $faker->name,
                'jabatan_id' => $faker->numberBetween(1, 3),
                'status_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
