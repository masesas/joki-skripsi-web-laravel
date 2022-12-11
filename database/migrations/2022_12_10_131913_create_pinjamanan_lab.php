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
        Schema::create('pinjamanan_lab', function (Blueprint $table) {
            $table->id();
            $table->string('nim_peminjam');
            $table->string('pinjam_type');
            $table->string('alat_id');
            $table->string('bahan_id');
            $table->integer('jumlah');
            $table->dateTime('tgl_kembali')->nullable();
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
        Schema::dropIfExists('pinjamanan_lab');
    }
};
