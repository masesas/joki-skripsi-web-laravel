<?php

namespace Database\Seeders;

use App\Models\AlatLab;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Schema;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();


        $alats = [
            [
                'nama_alat' => 'test alat 1',
                'ukuran' => 28,
                'satuan_ukuran' => 'ml',
                'jenis' => 'test jenis',
                'merk' => 'test merk',
                'lokasi_penyimpanan' => 'test lokasi',
                'jumlah_stock' => 10,
                'jumlah_dipinjam' => 0,
                'jumlah_pecah' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_alat' => 'test alat 2',
                'ukuran' => 20,
                'satuan_ukuran' => 'ml',
                'jenis' => 'test jenis 2',
                'merk' => 'test merk 2',
                'lokasi_penyimpanan' => 'test lokasi 2',
                'jumlah_stock' => 5,
                'jumlah_dipinjam' => 0,
                'jumlah_pecah' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($alats as $alat) {
            AlatLab::create($alat);
        }

        Schema::enableForeignKeyConstraints();
    }
}
