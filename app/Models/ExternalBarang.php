<?php

     namespace App\Models;

     use Illuminate\Database\Eloquent\Model;
    
     class ExternalBarang extends Model
     {
         protected $connection = 'external';  //koneksi database lain
         protected $table = 'items';  //sesuaikan nama tabel aslinya
    
         protected $fillable = [
             'nama_barang',
             'jenis_barang',
             'jumlah_barang',
             'berat_barang',
             'tanggal_masuk',
         ];
    
         public $timestamps = false;  //jika tidak ada kolom created_at / updated_at
     }
    
