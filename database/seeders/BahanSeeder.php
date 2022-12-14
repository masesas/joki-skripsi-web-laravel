<?php

namespace Database\Seeders;

use App\Models\BahanLab;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Schema;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();


        $bahans = [
            [
                'nama_bahan' => 'test bahan 1',
                'rumus_kimia' => 'test rumu 1',
                'fasa' => 'test fasa 1',
                'golongan' => 'test gol 1',
                'jumlah_stock' => 10,
                'jumlah_dipinjam' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bahan' => 'test bahan 2',
                'rumus_kimia' => 'test rumu 2',
                'fasa' => 'test fasa 2',
                'golongan' => 'test gol 2',
                'jumlah_stock' => 15,
                'jumlah_dipinjam' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($bahans as $bahan) {
            BahanLab::create($bahan);
        }

        Schema::enableForeignKeyConstraints();
    }
}
