<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Schema;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();


        $jadwals = [
            [
                'kelas' => 'test kelas 1',
                'hari' => 'test hari 1',
                'jam_mulai' => '07:00',
                'jam_selesai' => '08:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kelas' => 'test kelas 2',
                'hari' => 'test hari 2',
                'jam_mulai' => '09:00',
                'jam_selesai' => '10:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }

        Schema::enableForeignKeyConstraints();
    }
}
