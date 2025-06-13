<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ItemsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Item([
            'jenis_barang'   => $row['jenis_barang'],
            'nama_barang'    => $row['nama_barang'],
            'text_id'        => $row['id_barang'],
            'jumlah_barang'  => $row['jumlah_barang'],
            'Berat_barang'   => $row['berat_barang'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'jenis_barang'   => 'required',
            'nama_barang'    => 'required',
            'id_barang'      => 'required',
            'jumlah_barang'  => 'required|numeric',
            'berat_barang'   => 'required|numeric',
        ];
    }
}