<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penataan_gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->enum('jenis_barang', ['Obat Nyamuk Bakar','Obat Nyamuk Elektrik','Obat Nyamuk Oles','Obat Nyamuk Spray']);
            $table->integer('jumlah');
            $table->float('berat');
            $table->string('sektor')->nullable();
            $table->integer('koordinat_x');
            $table->integer('koordinat_y');
            $table->integer('koordinat_z');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penataan_gudang');
    }
};
