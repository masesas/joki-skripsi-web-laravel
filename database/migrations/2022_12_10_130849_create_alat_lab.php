<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_lab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->string('ukuran');
            $table->string('satuan_ukuran');//mL, cm, M, dsb
            $table->string('jenis');
            $table->string('merk');
            $table->string('lokasi_penyimpanan');
            $table->integer('jumlah_stock');
            $table->integer('jumlah_dipinjam')->default(0);
            $table->integer('jumlah_pecah')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_lab');
    }
};
