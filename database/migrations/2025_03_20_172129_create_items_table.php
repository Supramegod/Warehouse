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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_barang');
            $table->string('nama_barang');
            $table->string('text_id');
            $table->integer('jumlah_barang');
            $table->integer('Berat_barang');
            $table->timestamps();
        });
        

    }
};