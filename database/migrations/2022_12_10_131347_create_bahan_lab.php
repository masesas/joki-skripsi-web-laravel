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
        Schema::create('bahan_lab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahan');
            $table->string('rumus_kimia');
            $table->string('fasa');
            $table->string('golongan');
            $table->integer('jumlah_stock')->default(0);
            $table->integer('jumlah_dipinjam')->default(0);
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
        Schema::dropIfExists('bahan_lab');
    }
};
