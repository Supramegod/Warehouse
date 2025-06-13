<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenataanGudang extends Model
{
    protected $table = 'penataan_gudang';
    protected $connection = 'external';
    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'jumlah',
        'berat',
        'koordinat_x',
        'koordinat_y',
        'koordinat_z',
        'sektor',
        'text_id',
        'status', 
    ];
}
