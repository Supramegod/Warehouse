<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['jenis_barang', 'nama_barang', 'text_id', 'jumlah_barang','Berat_barang'];

}
